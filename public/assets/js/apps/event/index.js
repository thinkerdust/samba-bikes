var table = NioApp.DataTable('#dt-table', {
    serverSide: true,
    processing: true,
    responsive: false,
    searchDelay: 500,
    scrollX: true,
    scrollY: '500px',
    ajax: {
        url: '/admin/event/datatable',
        type: 'POST',
        data: function(d) {
            d._token        = token;
            d.start_date    = $('#start_date').val();
            d.end_date      = $('#end_date').val();
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
        {data: 'nama'},
        {data: 'tanggal'},
        {data: 'lokasi'},
        {data: 'tanggal_mulai'},
        {data: 'tanggal_selesai'},
        {data: 'harga', className: 'text-end', render: $.fn.dataTable.render.number( ',', '.', 0)},
        {data: 'stok', className: 'text-end', render: $.fn.dataTable.render.number( ',', '.', 0)},
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
                    0: {'title': 'Non Aktif', 'class': ' bg-danger'},
                    1: {'title': 'Aktif', 'class': ' bg-success'},
                    2: {'title': 'Release', 'class': ' bg-primary'}
                };
                if (typeof status[full['status']] === 'undefined') {
                    return data;
                }
                return '<span class="badge '+ status[full['status']].class +'">'+ status[full['status']].title +'</span>';
            }
        },
    ]
});

$('#btn-filter').click(function() {
    $("#dt-table").DataTable().ajax.reload();
})

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

function hapus(id) {
    Swal.fire({
        title: 'Apakah anda yakin akan hapus data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, saya yakin!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/admin/event/delete/'+id,
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
    $.ajax({
        url: '/admin/event/edit/'+id,
        dataType: 'json',
        success: function(response) {
            let data = response.data;
            if(data) {
                $('#modalDetail').modal('show');
                $('#nama').val(data.nama);
                $('#lokasi').val(data.lokasi);
                $('#tanggal').val(data.tanggal);
                $('#deskripsi').val(data.deskripsi);
                $('#tanggal_mulai_tiket').val(data.tanggal_mulai);
                $('#tanggal_selesai_tiket').val(data.tanggal_selesai);
                $('#harga').val(thousandView(data.harga));
                $('#stok').val(thousandView(data.stok));
                $('#nama_rekening').val(data.nama_rekening);
                $('#nomor_rekening').val(data.nomor_rekening);
                $('#bank').val(data.bank);
            }
        },
        error: function(error) {
            console.log(error)
            NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
        }
    })
}

function release(id) {
    Swal.fire({
        title: 'Apakah anda yakin akan menampilkan event?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, saya yakin!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/admin/event/release/'+id,
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