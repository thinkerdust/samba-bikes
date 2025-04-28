$(document).ready(function() {

    $.ajax({
        url: '/admin/dashboard/data',
        dataType: 'JSON',
        success: function(response) {
            if(response.status) {
                let data = response.data;

                let countUpPeserta      = new countUp.CountUp('total-peserta', data.total_peserta);
                let countUpKomunitas    = new countUp.CountUp('total-komunitas', data.total_komunitas);
                let countUpOrder        = new countUp.CountUp('total-order', data.total_order);
                let countUpRevenue      = new countUp.CountUp('total-revenue', data.total_revenue);

                if (!countUpPeserta.error) countUpPeserta.start();
                if (!countUpKomunitas.error) countUpKomunitas.start();
                if (!countUpOrder.error) countUpOrder.start();
                if (!countUpRevenue.error) countUpRevenue.start();
            }
        }
    })

    $('.card').on('click', function() {
        let target = $(this).data('target');
        if (target) {
            window.location.href = target;
        }
    });

})