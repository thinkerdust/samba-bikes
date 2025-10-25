$(document).ready(function() {
    $('.select2-size-chart').select2({
        allowClear: false,
        placeholder: "Select Size Chart",
        minimumResultsForSearch: Infinity,
        ajax: {
            url: '/admin/data-size-chart',
            dataType: "json",
            type: "get",
            data: function (params) {
                return { q: params.term };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nama,
                            id: item.nama
                        }
                    })
                };
            },
            cache: true
        }
    });
})

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
            d.event     = $('#filter_event').val();
            d.status    = $('#filter_status').val();
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
    order: [3, 'asc'],
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'nama_event', name: 'e.nama'},
        {data: 'nama_komunitas', orderable: false, searchable: false},
        {data: 'nama', name: 'p.nama'},
        {data: 'email', orderable: false, searchable: false},
        {data: 'gender'},
        {data: 'phone', name: 'p.phone'},
        {data: 'telp_emergency', name: 'p.telp_emergency'},
        {data: 'hubungan_emergency', name: 'p.hubungan_emergency'},
        {data: 'subtotal', name: 'od.subtotal', className: 'text-end', render: data => data ? thousandView(data) : '0' },
        {data: 'action', orderable: false, searchable: false},
    ],
    columnDefs: [
        {
            className: "nk-tb-col",
            targets: "_all"
        },
        {
            targets: 5,
            orderable: false,
            searchable: false,
            className: 'text-center',
            render: function(data, type, full, meta) {
                var gender = data === 'L' ? 'Laki-laki' : 'Perempuan';
                return gender;
            }
        },
    ],
    footerCallback: function (row, data, start, end, display) {
        const api = this.api();
        const sumColumn = i => api.column(i).data().reduce((a, b) => Number(a) + Number(b), 0);
    
        $(api.column(-2).footer()).html('Rp. ' + thousandView(sumColumn(-2)));
    }
});

$('#btn-filter').click(function() {
    $("#dt-table").DataTable().ajax.reload();
})

const thousandView = (number = 0) => {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

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
                $('#id_komunitas').val(data.id_komunitas);
                $('#nomor_order').val(data.nomor_order);
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
                initializeSelect2('#size_jersey', '/admin/data-size-chart', data.size_jersey);
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

$('#btn-export').click(function() {
    let event   = $('#filter_event').val();
    let status  = $('#filter_status').val();
    if(event && status) {
        location.href = '/admin/peserta/export/'+event+'/'+status;
    }else{
        NioApp.Toast('Pilih event terlebih dahulu!', 'warning', {position: 'top-right'});    
    }
})

function resendEmail(id_event, nomor_order, email)
{
    Swal.fire({
        title: 'Apakah anda yakin akan mengirim ulang email?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, saya yakin!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/admin/peserta/resend-email',
                type: 'POST',
                dataType : "JSON",
                data: {
                    _token: token,
                    id_event: id_event,
                    nomor_order: nomor_order,
                    email: email
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Please wait while we load the data.',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    if(response.status){
                        NioApp.Toast(response.message, 'success', {position: 'top-right'});
                    }else{
                        NioApp.Toast(response.message, 'warning', {position: 'top-right'});
                    }
                    Swal.close();
                },
                error: function(error) {
                    Swal.close();
                    NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
                }
            });
        }
    });
}