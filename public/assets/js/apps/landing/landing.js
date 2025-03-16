let hargaEvent = 0;

function openModal() {
    let modal = document.getElementById("modalKonfirmasi");
    modal.style.display = "flex";
    setTimeout(() => modal.style.opacity = "1", 10);
}

function closeModal() {
    let modal = document.getElementById("modalKonfirmasi");
    modal.style.opacity = "0";
    setTimeout(() => modal.style.display = "none", 300);

    // refresh form
    clearForm();
}

function clearForm() {
    $('#registerPersonal')[0].reset();
    $('#registerKomunitas')[0].reset();
    $('#listPeserta').empty();
    changeTotalPeserta();
    changeTotalHarga();
}

// Close when clicking outside the modal
window.onclick = function(event) {
    let modal = document.getElementById("modalKonfirmasi");
    if (event.target === modal) {
        closeModal();
    }
};

function changeTotalPeserta() {
    let totalPeserta = $('#listPeserta tr').length;
    $('#totalPeserta').text(totalPeserta);
}

function changeTotalHarga() {
    let totalPeserta = $('#listPeserta tr').length;
    let totalHarga = totalPeserta * hargaEvent;
    $('#totalHarga').text('Rp. ' + totalHarga.toLocaleString('id-ID'));
}

$(document).ready(function() {

    // get harga per tiket
    function getHarga() {
        $.ajax({
            url: '/get-harga',
            type: 'GET',
            success: function(response) {
                hargaEvent = response.harga;
                console.log('harga', hargaEvent);
                changeTotalHarga()
            }
        });
    }

    getHarga();

    $(document).on('focus', '.tanggal', function () {
        console.log('focus')
        $(this).datepicker();
    });

    // Remove peserta
    $(document).on('click', '#removePeserta', function() {
        $(this).closest('tr').remove();

        // change total peserta
        changeTotalPeserta();
        changeTotalHarga()
    });

    $('#addPeserta').click(function() {
        let newRow = `
            <tr>
                <td><input type="text" name="nama[]" placeholder="Nama Peserta"></td>
                <td>
                    <select class="nice-select" id="gender" name="gender[]" autocomplete="no" style="z-index: 0; padding: 15px 0; color: #aaa;">
                        <option value="" disabled selected>Jenis Kelamin</option>
                        <option value="L" style="font-size: 14px;">Laki-laki</option>
                        <option value="P" style="font-size: 14px;">Perempuan</option>
                    </select>
                </td>
                <td><input type="date" name="tanggal_lahir[]" class="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" autocomplete="no"></td>
                <td><input type="text" name="nik[]" placeholder="No KTP"></td>
                <td><input type="text" name="telp_emergency[]" placeholder="No Telepon"></td>
                <td><input type="text" name="hubungan_emergency[]" placeholder="Hubungan"></td>
                <td>
                    <select class="nice-select" id="blood" name="blood[]" placeholder="Gol Darah" autocomplete="no" style="z-index: 0; padding: 15px 0; color: #aaa;">
                        <option value="" disabled selected>Gol Darah</option>
                        <option value="A" style="font-size: 14px;">A</option>
                        <option value="B" style="font-size: 14px;">B</option>
                        <option value="AB" style="font-size: 14px;">AB</option>
                        <option value="O" style="font-size: 14px;">O</option>
                    </select>
                </td>
                <td>
                    <select class="nice-select" id="jersey" name="jersey[]" placeholder="Ukuran Jersey" autocomplete="no" style="width: 220px !important; z-index: 0;">
                        <option value="" disabled selected>Ukuran Jersey</option>
                        <option value="S" style="font-size: 14px;">S</option>
                        <option value="M" style="font-size: 14px;">M</option>
                        <option value="L" style="font-size: 14px;">L</option>
                        <option value="XL" style="font-size: 14px;">XL</option>
                    </select>
                </td>
                <td><button type="button" class="btn" id="removePeserta"><span>X</span></button></td>
            </tr>
        `;

        let $newRow = $(newRow);
        $('#listPeserta').append($newRow);

        // Reinitialize only the newly added selects
        $newRow.find('.nice-select').each(function() {
            $(this).niceSelect();
            // give css z-index = 0
        });

        // change total peserta
        changeTotalPeserta();
        changeTotalHarga()
    });

})

$('#registerPersonal').submit(function(e) {
    e.preventDefault();

    var btn = $('#btn-submit-personal');

    let formData = new FormData($('#registerPersonal')[0]);
        formData.append('type', 'personal');

    // proses ajax
    $.ajax({
        url: '/register-peserta',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            btn.attr('disabled', true);
            btn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>Loading ...</span>`);
        },
        success: function(response) {
            let data = response.data;
            if(response.status) {
                openModal();
            }
            btn.attr('disabled', false);
            btn.html('Register');
        },
        error: function(error) {
            console.log(error)
        }
    });
});

$('#registerKomunitas').submit(function(e) {
    e.preventDefault();

    var btn = $('#btn-submit-komunitas');

    let formData = new FormData($('#registerKomunitas')[0]);
        formData.append('type', 'komunitas');

    // proses ajax
    $.ajax({
        url: '/register-peserta',
        type : "POST",
        dataType : "JSON",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            btn.attr('disabled', true);
            btn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>Loading ...</span>`);
        },
        success: function(response) {
            let data = response.data;
            if(response.status) {
                openModal();
            }
            btn.attr('disabled', false);
            btn.html('Register');
        },
        error: function(error) {
            console.log(error)
        }
    });
});
