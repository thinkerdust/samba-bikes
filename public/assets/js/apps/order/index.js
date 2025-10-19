const table = () => NioApp.DataTable('#dt-table', {
    serverSide: true,
    processing: true,
    responsive: false,
    searchDelay: 500,
    scrollX: true,
    scrollY: '500px',
    ajax: {
        url: '/admin/order/datatable',
        type: 'POST',
        data: function(d) {
            d._token        = token;
            d.start_date    = $('#filter_start_date').val();
            d.end_date      = $('#filter_end_date').val();
            d.event         = $('#filter_event').val();
            d.status        = $('#filter_status').val();
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
        {data: 'nomor', name: 'order.nomor'},
        {data: 'email', name: 'order.email'},
        {data: 'tanggal_order', name: 'order.insert_at'},
        {data: 'tanggal_bayar', name: 'order.tanggal_bayar', render: function(data) { return data ? data : ''; }},
        {data: 'jumlah', name: 'order.jumlah', className: 'text-end'},
        {data: 'total', name: 'order.total', render: data => data ? 'Rp. ' + thousandView(data) : 'Rp. 0' },
        {data: 'status'},
        {data: 'action', orderable: false, searchable: false},
    ],
    columnDefs: [
        {
            className: "nk-tb-col",
            targets: "_all"
        },
        {
            targets: -2,
            orderable: false,
            searchable: false,
            className: 'text-center',
            render: function(data, type, full, meta) {

                var status = {
                    1: {'title': 'Pending', 'class': ' bg-warning'},
                    2: {'title': 'Paid', 'class': ' bg-success'},
                    0: {'title': 'Deleted', 'class': ' bg-danger'},
                };
                if (typeof status[full['status']] === 'undefined') {
                    return data;
                }
                return '<span class="badge '+ status[full['status']].class +'">'+ status[full['status']].title +'</span>';
            }
        }
    ],
    // footer sum total and jumlah
    footerCallback: function (row, data, start, end, display) {
        const api = this.api();
        const sumColumn = i => api.column(i).data().reduce((a, b) => Number(a) + Number(b), 0);
    
        $(api.column(5).footer()).html(thousandView(sumColumn(5)));
        $(api.column(6).footer()).html('Rp. ' + thousandView(sumColumn(6)));
    }
});

$('#btn-filter').click(function() {
    $("#dt-table").DataTable().ajax.reload();
})

const thousandView = (number = 0) => {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

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

const keyUpThousandView = (evt) => {
    let currentValue = (evt.currentTarget.value != '') ? evt.currentTarget.value.replaceAll('.','') : '0';
    let iNumber = parseInt(currentValue);
    let result = isNaN(iNumber) == false ? thousandView(iNumber) : '0';
    evt.currentTarget.value = result;
}

$('.format-currency').on('keyup', (evt) => {
    keyUpThousandView(evt)
})

function hapus(nomor) {
    Swal.fire({
        title: 'Apakah anda yakin akan hapus data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, saya yakin!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/admin/order/delete?nomor='+nomor,
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

function detail(nomor) {

    $("#modalDetail").modal("show");

    NioApp.DataTable('#dt-table-detail', {
        destroy: true, 
        serverSide: false,
        processing: true,
        responsive: false,
        searchDelay: 500,
        scrollX: true,
        scrollY: '250px',
        ajax: {
            url: '/admin/order/detail?nomor=' + nomor,
            dataType: 'json',
            beforeSend: function () {
                blockUI();
            },
            complete: function () {
                unBlockUI();
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error, xhr.responseText);
                NioApp.Toast('Error while fetching data: ' + error, 'error', { position: 'top-right' });
            }
        },
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'nama_peserta', name: 'p.nama'},
            {
                data: null,
                name: 'p.phone',
                render: function(data, type, full, meta) {
                    return data.phone ? data.phone : data.telp_emergency;
                }
            },
            {data: 'email', name: 'p.email'},
            {data: 'size_jersey', name: 'p.size_jersey'},
            {data: 'subtotal', name: 'p.subtotal', render: function(data) { return data ? 'Rp. ' + thousandView(data) : 'Rp. 0' }},
            {data: 'nomor_urut', name: 'p.nomor_urut'},
            {data: 'status', name: 'p.status', render: function(data) {
                var status = {
                    1: {'title': 'Aktif', 'class': ' bg-success'},
                    0: {'title': 'Non-Aktif', 'class': ' bg-danger'},
                };
                if (typeof status[data] === 'undefined') {
                    return data;
                }
                return '<span class="badge '+ status[data].class +'">'+ status[data].title +'</span>';
            }},
        ],
        columnDefs: [
            {
                className: "nk-tb-col",
                targets: "_all"
            }
        ]
    });
    
}

function payment(nomor) {
    $('#form-data-payment')[0].reset();
    $.ajax({
        url: '/admin/order/edit?nomor=' + nomor,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                $("#modalPayment").modal("show");
                $('#nomor_order').val(nomor);
                $('#email').val(response.data.email);
                $('#total_bayar').val('Rp ' + thousandView(response.data.total));
            } else {
                NioApp.Toast(response.message, 'warning', {position: 'top-right'});
            }
        },
        error: function(error) {
            NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
        }
    });
}

$('#form-data-payment').submit(function(e) {
    e.preventDefault();
    formData = new FormData($(this)[0]);
    var btn = $('#btn-submit-payment');

    Swal.fire({
        title: 'Apakah anda yakin akan simpan data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, saya yakin!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url : "/admin/order/payment",  
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
                    if(response.status) {
                        $("#dt-table").DataTable().ajax.reload(null, false);
                        NioApp.Toast(response.message, 'success', {position: 'top-right'});
                        $('#modalPayment').modal('hide');
                    } else {
                        NioApp.Toast(response.message, 'warning', {position: 'top-right'});
                    }
                    btn.attr('disabled', false);
                    btn.html('Submit');
                },
                error: function(error) {
                    btn.attr('disabled', false);
                    btn.html('Submit');
                    NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
                }
            });
        }
    })
});

function resendEmail(nomor) {
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                data: {
                    nomor: nomor
                },
                success: function(response) {
                    if(response.status){
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