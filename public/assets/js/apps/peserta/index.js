const table = () => NioApp.DataTable('#dt-table', {
    serverSide: true,
    processing: true,
    responsive: false,
    searchDelay: 500,
    scrollX: true,
    scrollY: '500px',
    ajax: {
        url: '/admin/peserta/datatable',
        type: 'POST',
        data: function(d) {
            d._token    = token;
            d.event    = $('#filter_event').val();
        },
        beforeSend: function () {
            blockUI();
        },
        complete: function () {
            unBlockUI();
        },
        error: function (xhr) {
            if (xhr.status === 419) { // Unauthorized error
                NioApp.Toast('Your session has expired. Redirecting to login...', 'error', {position: 'top-right'});
                window.location.href = "/login"; 
            } else {
                NioApp.Toast('An error occurred while loading data. Please try again.', 'error', {position: 'top-right'});
            }
        }
    },
    order: [1, 'ASC'],
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'nama_event'},
        {data: 'nama'},
        {data: 'nama'},
        {data: 'gender'},
        {data: 'phone'},
        {data: 'telp_emergency'},
        {data: 'hubungan_emergency'},
        {data: 'action', orderable: false, searchable: false},
    ],
    columnDefs: [
        {
            className: "nk-tb-col",
            targets: "_all"
        },
        {
            targets: 2,
            render: function(data, type, full, meta) {
                if(full.nama_komunitas_personal != null) {
                    return full.nama_komunitas_personal;
                } else {
                    return full.nama_komunitas;
                }
            }
        },
        {
            targets: 4,
            orderable: false,
            searchable: false,
            className: 'text-center',
            render: function(data, type, full, meta) {
                var gender = data === 'L' ? 'Laki-laki' : 'Perempuan';
                return gender;
            }
        },
    ]
});

$('#btn-filter').click(function() {
    $("#dt-table").DataTable().ajax.reload();
})

$('.select2-js').select2({
    minimumResultsForSearch: Infinity
});

function initializeSelect2(elementId, url, selectedValue, additionalParams = {}, callback = null) {
    const element = $(elementId);
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        data: { ...additionalParams },
    }).done(function (res) {
        if (selectedValue) {
            const response = res.find(o => o.id == selectedValue);
            if (response) {
                const option = new Option(response.nama, response.id, true, true);
                element.append(option).trigger('change');
            }
        }
        if (callback) callback(); // Ensure table() is called after data loads
    });
}

$('.event').each(async function() {
    var dropdownParent = null;

    if ($(this).closest('.modal').length > 0) {
        dropdownParent = $(this).closest('.modal');
    }

    $(this).select2({
        placeholder: 'Pilih Event',
        dropdownParent: dropdownParent,
        allowClear: true,
        ajax: {
            url: '/admin/data-event',
            dataType: "json",
            type: "GET",
            delay: 250,
            data: function (params) {
                return { q: params.term, release: true };
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
    });

    initializeSelect2('#filter_event', '/admin/data-event', 1, null, function () {
        table();
    });
}); 

function detailOrEdit(id) {
    $.ajax({
        url: '/admin/peserta/edit/'+id,
        dataType: 'json',
        success: function(response) {
            let data = response.data;
            if (data) {
                $('#modalDetailEdit').modal('show');
            
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#nama_komunitas').val(data.nama_komunitas);
                $('#phone').val(data.phone);
                $('#telp_emergency').val(data.telp_emergency);
                $('#hubungan_emergency').val(data.hubungan_emergency);
                $('#email').val(data.email);
                $('#nik').val(data.nik);
                $('#kota').val(data.kota);
                $('#alamat').val(data.alamat);
            
                // Datepicker
                $('#tanggal_lahir').val(data.tgl_lahir).trigger('change');

                // Select2
                $('#blood').val(data.blood).trigger('change');
                $('#gender').val(data.gender).trigger('change');
            }
        },
        error: function(error) {
            NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
        }
    })
}

$('#form-data').submit(function(e) {
    e.preventDefault();
    formData = new FormData($(this)[0]);
    var btn = $('#btn-submit');

    $.ajax({
        url: '/admin/peserta/store',
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
                $('#modalDetailEdit').modal('hide');
                $("#dt-table").DataTable().ajax.reload(null, false);
            }else{
                NioApp.Toast(response.message, 'warning', {position: 'top-right'});
            }
            btn.attr('disabled', false);
            btn.html('Update');
        },
        error: function(error) {
            btn.attr('disabled', false);
            btn.html('Update');
            NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
        }
    });
});