var table = NioApp.DataTable('#dt-table', {
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
        {data: 'nama_event', name: 'event.nama'},
        {data: 'nomor', name: 'order.nomor'},
        {data: 'jumlah', name: 'order.jumlah', className: 'text-end'},
        {data: 'total', name: 'order.total'},
        {data: 'tanggal_order', name: 'order.insert_at'},
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
                    2: {'title': 'Paid', 'class': ' bg-success'}
                };
                if (typeof status[full['status']] === 'undefined') {
                    return data;
                }
                return '<span class="badge '+ status[full['status']].class +'">'+ status[full['status']].title +'</span>';
            }
        },
        {
            targets: 4, 
            className: 'text-end',
            render: function(data, type, full, meta) {
                if (!data) return 'Rp 0'; // Jika data kosong, tampilkan Rp 0
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(data);
            }
        }
    ]
});

$('#btn-filter').click(function() {
    $("#dt-table").DataTable().ajax.reload();
})

const thousandView = (number = 0) => {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

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
                    console.log(error)
                    NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
                }
            })
        }
    });
}

function detail(nomor) {

    // open modal
    $("#modalDetail").modal("show");

    NioApp.DataTable('#dt-table-detail', {
        scrollX: true,
        destroy: true, 
        stateSave: true,
        responsive: false,
        serverSide: false,
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
        order: [1, 'ASC'], // Sort by the second column (nomor_order)
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'nama_peserta', name: 'p.nama'},
            {data: 'phone', name: 'p.phone'},
            {data: 'email', name: 'p.email'},
            {data: 'size_jersey', name: 'p.size_jersey'},
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
                $('#id_order').val(response.data.id);
                $('#total_bayar').val('Rp ' + thousandView(response.data.total));
            } else {
                NioApp.Toast(response.message, 'warning', {position: 'top-right'});
            }
        },
        error: function(error) {
            console.log(error)
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
                    console.log(error)
                    btn.attr('disabled', false);
                    btn.html('Submit');
                    NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
                }
            });
        }
    })
});