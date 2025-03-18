$(document).ready(function() {
    const thousandView = (number = 0) => {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    const keyUpThousandView = (evt) => {
        let currentValue = (evt.currentTarget.value != '') ? evt.currentTarget.value.replaceAll('.','') : '0';
        let iNumber = parseInt(currentValue);
        let result = isNaN(iNumber) == false ? thousandView(iNumber) : '0';
        evt.currentTarget.value = result;
    }

    $('.format-currency').on('keyup', (evt) => {
        keyUpThousandView(evt)
    })

    $('.format-number').keyup(function() {
        $(this).val(function (index, value) {
          return value.replace(/\D/g, "");
        });
    });

    $('#bank').select2({
        placeholder: 'Pilih Bank',
        ajax: {
            url: '/admin/data-bank',
            dataType: "json",
            type: "GET",
            delay: 250,
            data: function (params) {
                return { q: params.term };
            },
            processResults: function (data, params) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nama,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })

    let id = $('#id').val();
    if(id) {
        $.ajax({
            url: '/admin/event/edit/'+id,
            dataType: 'json',
            success: function(response) {
                let data = response.data;
                if(data) {
                    $('#nama').val(data.nama);
                    $('#phone').val(data.phone);
                    $('#email').val(data.email);
                    $('#nama_rekening').val(data.nama_rekening);
                    $('#nomor_rekening').val(data.nomor_rekening);
                    $('#lokasi').val(data.lokasi);
                    $('#tanggal').datepicker('setDate', data.tanggal);
                    $('#deskripsi').val(data.deskripsi);
                    $('#tanggal_mulai_tiket').datepicker('setDate', data.tanggal_mulai);
                    $('#tanggal_selesai_tiket').datepicker('setDate', data.tanggal_selesai);
                    $('#harga').val(thousandView(data.harga));
                    $('#stok').val(thousandView(data.stok));
                    $("#bank").empty().append(`<option value="${data.bank}">${data.bank}</option>`).val(data.bank).trigger('change');

                    let link_storage = '/storage/uploads/';

                    if(data.banner) {
                        $('#preview_image_banner').attr('src', link_storage+data.banner);
                        $('#sectionBanner').html(`<a target="_blank" href="${link_storage+data.banner}" class="btn btn-info btn-sm">Link File Banner</a>`);
                        $('#old_banner').val(data.banner);
                    }

                    if(data.size_chart) {
                        $('#preview_image_size_chart').attr('src', link_storage+data.size_chart);
                        $('#sectionSizeChart').html(`<a target="_blank" href="${link_storage+data.size_chart}" class="btn btn-info btn-sm">Link File Size Chart</a>`);
                        $('#old_size_chart').val(data.size_chart);
                    }

                    if(data.rute) {
                        $('#preview_image_rute').attr('src', link_storage+data.rute);
                        $('#sectionRute').html(`<a target="_blank" href="${link_storage+data.rute}" class="btn btn-info btn-sm">Link File Rute</a>`);
                        $('#old_rute').val(data.rute);
                    }
                }
            },
            error: function(error) {
                console.log(error)
                NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
            }
        })
    }

    $('#form-data').submit(function(e) {
        e.preventDefault();
        formData = new FormData($(this)[0]);
        var btn = $('#btn-submit');

        $.ajax({
            url : "/admin/event/store",  
            data : formData,
            type : "POST",
            dataType : "JSON",
            cache:false,
            async : true,
            contentType: false,
            processData: false,
            beforeSend: function() {
                btn.attr('disabled', true);
                btn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>Loading ...</span>`);
            },
            success: function(response) {
                if(response.status){
                    NioApp.Toast(response.message, 'success', {position: 'top-right'});
                    setTimeout(function(){
                        window.location.href = '/admin/event';
                    }, 2000)
                }else{
                    NioApp.Toast(response.message, 'warning', {position: 'top-right'});
                }
                btn.attr('disabled', false);
                btn.html('Save');
            },
            error: function(error) {
                console.log(error)
                btn.attr('disabled', false);
                btn.html('Save');
                NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
            }
        });
    });
})

$('#preview_image_banner').attr('src', "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.png");

$('#banner').on('change', function() {

    // The recommended plugin to animate custom file input: bs-custom-file-input, is what bootstrap using currently
    // bsCustomFileInput.init();

    // Set maximum filesize
    var maxSizeMb = 2;

    // Get the file by using JQuery's selector
    var file = $('#banner')[0].files[0];

    // Make sure that a file has been selected before attempting to get its size.
    if(file !== undefined) {

        // Get the filesize
        var totalSize = file.size;

        // Convert bytes into MB
        var totalSizeMb = totalSize  / Math.pow(1024,2);

        // Check to see if it is too large.
        if(totalSizeMb > maxSizeMb) {

            // Create an error message
            var errorMsg = 'File too large. Maximum file size is ' + maxSizeMb + ' MB. Selected file is ' + totalSizeMb.toFixed(2) + ' MB';
            NioApp.Toast(errorMsg, 'warning', {position: 'top-right'});

            // Clear the value
            $('#banner').val('');
            $('#preview_image_banner').attr('src', "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.png");
            $('#banner').next('label').html('Choose file');
        }else{
            readURL(this,'preview_image_banner');
        }
    }
});

$('#preview_image_size_chart').attr('src', "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.png");

$('#size_chart').on('change', function() {

    // The recommended plugin to animate custom file input: bs-custom-file-input, is what bootstrap using currently
    // bsCustomFileInput.init();

    // Set maximum filesize
    var maxSizeMb = 2;

    // Get the file by using JQuery's selector
    var file = $('#size_chart')[0].files[0];

    // Make sure that a file has been selected before attempting to get its size.
    if(file !== undefined) {

        // Get the filesize
        var totalSize = file.size;

        // Convert bytes into MB
        var totalSizeMb = totalSize  / Math.pow(1024,2);

        // Check to see if it is too large.
        if(totalSizeMb > maxSizeMb) {

            // Create an error message
            var errorMsg = 'File too large. Maximum file size is ' + maxSizeMb + ' MB. Selected file is ' + totalSizeMb.toFixed(2) + ' MB';
            NioApp.Toast(errorMsg, 'warning', {position: 'top-right'});

            // Clear the value
            $('#size_chart').val('');
            $('#preview_image_size_chart').attr('src', "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.png");
            $('#size_chart').next('label').html('Choose file');
        }else{
            readURL(this,'preview_image_size_chart');
        }
    }
});

$('#preview_image_rute').attr('src', "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.png");

$('#rute').on('change', function() {

    // The recommended plugin to animate custom file input: bs-custom-file-input, is what bootstrap using currently
    // bsCustomFileInput.init();

    // Set maximum filesize
    var maxSizeMb = 2;

    // Get the file by using JQuery's selector
    var file = $('#rute')[0].files[0];

    // Make sure that a file has been selected before attempting to get its size.
    if(file !== undefined) {

        // Get the filesize
        var totalSize = file.size;

        // Convert bytes into MB
        var totalSizeMb = totalSize  / Math.pow(1024,2);

        // Check to see if it is too large.
        if(totalSizeMb > maxSizeMb) {

            // Create an error message
            var errorMsg = 'File too large. Maximum file size is ' + maxSizeMb + ' MB. Selected file is ' + totalSizeMb.toFixed(2) + ' MB';
            NioApp.Toast(errorMsg, 'warning', {position: 'top-right'});

            // Clear the value
            $('#rute').val('');
            $('#preview_image_rute').attr('src', "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.png");
            $('#rute').next('label').html('Choose file');
        }else{
            readURL(this,'preview_image_rute');
        }
    }
});

const readURL = (input,el) => {
    if (input.files && input.files[0]) {
        const reader = new FileReader()
        reader.onload = (e) => {
            $('#'+el).removeAttr('src')
            $('#'+el).attr('src', e.target.result)

            let fileName = input.files[0].name;

            // get attr id from input
            let label = input.getAttribute('id');
            $('#label_' + label).html(fileName);

        }
        reader.readAsDataURL(input.files[0])
    }
};