var table = NioApp.DataTable('#dt-table', {
    serverSide: true,
    processing: true,
    responsive: true,
    searchDelay: 500,
    scrollX: true,
    ajax: {
        url: '/admin/order/racepack/datatable',
        type: 'POST',
        data: function(d) {
            d._token   = token;
            d.nomor    = $('#nomor').val();
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
        {data: 'id'},
        {data: 'nama_peserta', name: 'p.nama'},
        {data: 'size_jersey', name: 'p.size_jersey'},
        {data: 'racepack_at', name: 'od.racepack_at'},
        {data: 'racepack_by', name: 'od.racepack_by'}
    ],
    columnDefs: [
        {
            className: "nk-tb-col",
            targets: "_all"
        },
        {
            targets: 1,
            orderable: false, 
            searchable: false,
            render: (data, type, row, meta) => {
                if(row.racepack_at && row.racepack_by) {
                    return '';
                }else{
                    return `<div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" name="row_check[]" class="custom-control-input row-check" id="check_${data}" data-id="${data}" value="${data}">
                            <label class="custom-control-label" for="check_${data}"></label>
                        </div>`; 
                }
            }
        },
    ]
});

// Handle click on "Check All" control
$('#check_all').click(function() {
    let rows = $('#dt-table').DataTable().rows({ 'search': 'applied' }).nodes();

    if ($('#check_all').is(':checked')) {
        $('input[name="row_check[]"]', rows).prop("checked", true);
    }  else {
        $('input[name="row_check[]"]', rows).prop("checked", false);
    }
});

// Handle click on individual checkboxes to update "Check All" control
$('#dt-table tbody').on('change', '.row-check', function() {
    let totalCheckboxes = $('.row-check').length;
    let checkedCheckboxes = $('.row-check:checked').length;
    $('#check_all').prop('checked', totalCheckboxes === checkedCheckboxes);
});

function take_racepack()
{
    let rows = $('#dt-table').dataTable().fnGetNodes();
    checkedData = [];
    $.each($('.row-check:checked', rows), function(){
        checkedData.push($(this).attr('data-id'));
    });

    if(checkedData.length > 0) {
        $('#modalForm').modal('show');
        $('#form-data')[0].reset();
        $('#id_order_detail').val(checkedData);
    }else{
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Mohon pilih data terlebih dahulu"
        });
    }   
}

$('#form-data').submit(function(e) {
    e.preventDefault();
    formData = new FormData($(this)[0]);
    var btn = $('#btn-submit');

    Swal.fire({
        title: 'Apakah anda yakin akan simpan data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, saya yakin!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url : "/admin/order/racepack/store",  
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
                        $('#form-data')[0].reset();
                        $('#modalForm').modal('hide');
                        $("#dt-table").DataTable().ajax.reload(null, false);
                        $('#check_all').prop('checked', false);
                        NioApp.Toast(response.message, 'success', {position: 'top-right'});
                    }else{
                        NioApp.Toast(response.message, 'warning', {position: 'top-right'});
                    }
                    btn.attr('disabled', false);
                    btn.html('Save');
                },
                error: function(error) {
                    btn.attr('disabled', false);
                    btn.html('Save');
                    NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
                }
            });
        }
    })
});