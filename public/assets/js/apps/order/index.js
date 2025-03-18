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
        {data: 'nama_event'},
        {data: 'nomor'},
        {data: 'jumlah'},
        {data: 'total'},
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
                    3: {'title': 'Confirmed', 'class': ' bg-primary'}
                };
                if (typeof status[full['status']] === 'undefined') {
                    return data;
                }
                return '<span class="badge '+ status[full['status']].class +'">'+ status[full['status']].title +'</span>';
            }
        },
        {
            targets: 4, // Kolom "total"
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

function hapus(id) {
    Swal.fire({
        title: 'Apakah anda yakin akan hapus data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, saya yakin!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/admin/order/delete/'+id,
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

function detail(id) {

    // open modal
    $("#modalDetail").modal("show");

    NioApp.DataTable('#dt-table-detail', {
        scrollX: true,
        destroy: true, // `bDestroy` is an older option, `destroy` is preferred
        stateSave: true,
        responsive: false,
        serverSide: false,
        ajax: {
            url: '/admin/order/detail/' + id,
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
        order: [[1, 'asc']], // Sort by the second column (nomor_order)
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nomor_order' },
            { data: 'nama_peserta' },
            { data: 'size' },
            {data: 'status'},
        ],
        columnDefs: [
            {
                className: "nk-tb-col",
                targets: "_all"
            },
            {
                targets: -1,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function(data, type, full, meta) {
    
                    var status = {
                        0: {'title': 'Non Aktif', 'class': ' bg-danger'},
                        1: {'title': 'Aktif', 'class': ' bg-success'},
                    };
                    if (typeof status[full['status']] === 'undefined') {
                        return data;
                    }
                    return '<span class="badge '+ status[full['status']].class +'">'+ status[full['status']].title +'</span>';
                }
            },
        ]
    });
    
}

function konfirmasi(id) {

    // clear form
    $('#form-data')[0].reset();
    
    // open modal
    $("#modalKonfirmasi").modal("show");

    // populate form with data
    $.ajax({
        url: '/admin/order/edit/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                // Populate the form fields with the response data
                $('#id_order').val(response.data.id);
                $('#total_bayar').val(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(response.data.total));
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

$('#form-data').submit(function(e) {
    e.preventDefault();
    formData = new FormData($(this)[0]);
    var btn = $('#btn-submit');

    $.ajax({
        url : "/admin/order/konfirmasi",  
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

                // close modal
                $('#modalKonfirmasi').modal('hide');
            } else {
                NioApp.Toast(response.message, 'warning', {position: 'top-right'});
            }
            btn.attr('disabled', false);
            btn.html('Konfirmasi');
        },
        error: function(error) {
            console.log(error)
            btn.attr('disabled', false);
            btn.html('Konfirmasi');
            NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
        }
    });
});