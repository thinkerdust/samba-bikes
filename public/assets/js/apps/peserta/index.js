var table = NioApp.DataTable('#dt-table', {
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

const initializeSelect2 = async (elementId, type, selectedValue, additionalParams = {}) => {
    const element = $(elementId);
    const res = await $.ajax({
        type: 'GET',
        url: base_url + '/master/select2',
        data: { tipe: type, ...additionalParams },
    });

    if(selectedValue) {
        const response = res.results.find(o => o.id == selectedValue);
        const option = new Option(response.text, response.id, true, true);
        element.append(option).trigger('change');
    }
}

$('.event').each(function() {
    var dropdownParent = null;
    // Check if the element has a parent with class 'modal'
    if ($(this).closest('.modal').length > 0) {
        // If it has a parent with class 'modal', set dropdownParent
        dropdownParent = $(this).closest('.modal');
    }

    // Initialize Select2 dropdown for the current element
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
    });
}); 

function hapus(id) {
    Swal.fire({
        title: 'Apakah anda yakin akan hapus data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, saya yakin!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/admin/peserta/delete/'+id,
                dataType: 'JSON',
                success: function(response) {
                    if(response.status){
                        $("#dt-table").DataTable().ajax.reload(null, false);
                        NioApp.Toast(response.message, 'success', {position: 'top-right'});
                    }else{
                        NioApp.Toast(response.message, 'warning', {position: 'top-right'});
                    }
                },
                error: function(error) {
                    NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
                }
            })
        }
    });
}

function detail(id) {
    $.ajax({
        url: '/admin/peserta/edit/'+id,
        dataType: 'json',
        success: function(response) {
            let data = response.data;
            console.log(data)
            if (data) {
                $('#modalDetail').modal('show');
            
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
            console.log(error)
            NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
        }
    })
}