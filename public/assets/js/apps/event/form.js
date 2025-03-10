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

    let kode = $('#kode').val();
    if(kode) {
        $.ajax({
            url: '/admin/event/edit/'+kode,
            dataType: 'json',
            success: function(response) {
                let data = response.data;
                if(data) {
                    $('#nama').val(data.nama);
                    $('#lokasi').val(data.lokasi);
                    $('#tanggal').datepicker('setDate', data.tanggal);
                    $('#deskripsi').val(data.deskripsi);
                    $('#tanggal_mulai_tiket').datepicker('setDate', data.tanggal_mulai);
                    $('#tanggal_selesai_tiket').datepicker('setDate', data.tanggal_selesai);
                    $('#harga').val(thousandView(data.harga));
                    $('#stok').val(thousandView(data.stok));
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