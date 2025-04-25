let hargaEvent = 0;

function openModal() {
    let modal = document.getElementById("modalKonfirmasi");
    modal.style.display = "flex";
    setTimeout(() => modal.style.opacity = "1", 10);

    // Prevent closing the modal when clicking outside
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            event.stopPropagation();
        }
    });
}

function closeModal() {
    let modal = document.getElementById("modalKonfirmasi");
    modal.style.opacity = "0";
    setTimeout(() => modal.style.display = "none", 300);

    // refresh form
    clearForm();
    clearButtonSubmit()
}

function openModalOverride(listNama, onclick) {

    $('#info-peserta-terdaftar').text('Peserta ' + listNama + ' sudah terdaftar, apakah anda yakin ingin melanjutkan (data peserta lama akan dihapus) ?');
    $('#submit-override').attr('onclick', onclick);

    let modal = document.getElementById("modalOverride");
    modal.style.display = "flex";
    setTimeout(() => modal.style.opacity = "1", 10);
}

function closeModalOverride() {
    $('#info-peserta-terdaftar').text('');
    let modal = document.getElementById("modalOverride");
    modal.style.opacity = "0";
    setTimeout(() => modal.style.display = "none", 300);

    clearButtonSubmit()
}

function openModalError() {
    let modal = document.getElementById("modalError");
    modal.style.display = "flex";
    setTimeout(() => modal.style.opacity = "1", 10);
}

function closeModalError() {
    let modal = document.getElementById("modalError");
    modal.style.opacity = "0";
    setTimeout(() => modal.style.display = "none", 300);
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

function clearButtonSubmit() {

    var btnPersonal = $('#btn-submit-personal');
    var btnKomunitas = $('#btn-submit-komunitas');

    btnPersonal.attr('disabled', false);
    btnPersonal.html('Register');

    btnKomunitas.attr('disabled', false);
    btnKomunitas.html('Register');
}

$(document).ready(function() {

    // class .input-number buat input hanya angka
    $(document).on('input', '.input-number', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // get harga per tiket
    function getHarga() {
        $.ajax({
            url: '/get-harga',
            type: 'GET',
            success: function(response) {
                hargaEvent = response.harga;
                changeTotalHarga()
            }
        });
    }

    getHarga();

    $(document).on('focus', '.tanggal', function () {
        $(this).datepicker({
            dateFormat: 'dd/mm/yy'
        });
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
                <td><input type="text" name="nama[]" placeholder="Nama Peserta" required></td>
                <td>
                    <select class="nice-select" id="gender" name="gender[]" autocomplete="off" style="z-index: 0; padding: 15px 0; color: #aaa;">
                        <option value="">Jenis Kelamin</option>
                        <option value="L" style="font-size: 14px;">Laki-laki</option>
                        <option value="P" style="font-size: 14px;">Perempuan</option>
                    </select>
                </td>
                <td><input type="date" name="tanggal_lahir[]" class="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" autocomplete="off" required></td>
                <td><input type="text" class="input-number" name="nik[]" placeholder="No KTP" required></td>
                <td><input type="text" class="input-number" name="telp_emergency[]" placeholder="No Telepon" autocomplete="off" required></td>
                <td>
                    <select class="nice-select" id="hubungan_emergency[]" name="hubungan_emergency[]" placeholder="Hub Kontak Darurat" autocomplete="off">
                        <option value="" style="font-size: 14px;">Hub Kontak Darurat</option>
                        <option value="SAUDARA" style="font-size: 14px;">Saudara</option>
                        <option value="ORANG TUA" style="font-size: 14px;">Orang Tua</option>
                        <option value="SUAMI/ISTRI" style="font-size: 14px;">Suami/Istri</option>
                        <option value="ANAK" style="font-size: 14px;">Anak</option>
                    </select>
                </td>
                <td>
                    <select class="nice-select" id="blood" name="blood[]" placeholder="Gol Darah" autocomplete="off" style="z-index: 0; padding: 15px 0; color: #aaa;">
                        <option value="">Gol Darah</option>
                        <option value="A" style="font-size: 14px;">A</option>
                        <option value="B" style="font-size: 14px;">B</option>
                        <option value="AB" style="font-size: 14px;">AB</option>
                        <option value="O" style="font-size: 14px;">O</option>
                    </select>
                </td>
                <td>
                    <select class="nice-select" id="jersey" name="jersey[]" placeholder="Ukuran Jersey" autocomplete="off" style="width: 220px !important; z-index: 0;">
                        <option value="">Jersey</option>
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

    console.log('Submit Personal');

    var btn = $('#btn-submit-personal');

    // check peserta
    let nik = [];
    nik.push($(this).find('input[name="nik"]').val());

    // validasi form select harus diisi
    let gender              = $('#gender').val();
    let tgl_lahir           = $('#tanggal_lahir').val();
    let blood               = $('#blood').val();
    let hubungan_emergency  = $('#hubungan_emergency').val();
    let jersey              = $('#jersey').val();

    if(gender === '' || tgl_lahir === '' || blood === '' || hubungan_emergency === '' || jersey === '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops, ada yang terlewat!',
            text: 'Pastikan semua kolom pada form telah diisi dengan benar. Mohon periksa kembali!',
            footer: `<a href='https://wa.me/${phone}' target='_blank'>Butuh bantuan?</a>`,  // Optional: A link to help page
            showConfirmButton: true,
            confirmButtonText: 'Periksa Kembali',
            confirmButtonColor: '#0d5aa5',
            customClass: {
                title: 'font-weight-bold', // Makes the title bold for emphasis
                content: 'font-italic',    // Optional: Adds italics to content
            },
            showCloseButton: true,  // Optional: Adds a close button
            didOpen: () => {
                // Optional: You can focus a specific element or scroll to it
                document.querySelector('input').focus();  // Focus on the first input
            }
        })
        return;
    }

    $.ajax({
        url: '/check-peserta',
        type: 'POST',
        data: {
            nik: nik, 
            type: 'personal', 
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            btn.attr('disabled', true);
            btn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>Loading ...</span>`);
        },
        success: function(response) {
            let data = response.data;

            if(response.status) {
                if(data.length > 0) {
                    // peserta sudah terdaftar tampilan modal konfirmasi override
                    let pesertaTerdaftar = '';

                    data.forEach((item, index) => {
                        pesertaTerdaftar += `${item.nama}, `;
                    });

                    // remove last comma
                    pesertaTerdaftar = pesertaTerdaftar.slice(0, -2);

                    openModalOverride(pesertaTerdaftar, 'processRegisterPersonal()');
                } else {
                    processRegisterPersonal();
                }
            }
        },
        error: function(error) {
            btn.attr('disabled', false);
            btn.html('Register');
            console.log(error);

            openModalError();
        }
    });
});

function processRegisterPersonal() {

    var btn = $('#btn-submit-personal');

    console.log('Process Personal');

    let formData = new FormData($('#registerPersonal')[0]);
        formData.append('type', 'personal');

    $.ajax({
        url: '/register-peserta',
        type: 'POST',
        data: formData,
        dataType : "JSON",
        processData: false,
        contentType: false,
        success: function(response) {
            if(response.status) {
                closeModalOverride();
                openModal();
            }
            btn.attr('disabled', false);
            btn.html('Register');
        },
        error: function(error) {
            console.log(error);
            btn.attr('disabled', false);
            btn.html('Register');

            openModalError();
        }
    });
}

$('#registerKomunitas').submit(function(e) {
    e.preventDefault();

    console.log('Submit Komunitas');

    var btn = $('#btn-submit-komunitas');

    let nik                 = [];
    let gender              = [];
    let hubunganEmergency   = [];
    let blood               = [];
    let jersey              = [];
    let isValid             = true;

    $(this).find('input[name="nik[]"]').each(function() {
        nik.push($(this).val());
    });
    console.log(nik);

    $(this).find('select[name="gender[]"]').each(function() {
        gender.push($(this).val());
    });
    
    $(this).find('select[name="hubungan_emergency[]"]').each(function() {
        hubunganEmergency.push($(this).val());
    });

    $(this).find('select[name="blood[]"]').each(function() {
        blood.push($(this).val());
    });

    $(this).find('select[name="jersey[]"]').each(function() {
        jersey.push($(this).val());
    });

    // validasi harus minimalkan 1 peserta
    if(nik.length < 1) {
        Swal.fire({
            icon: 'error',
            title: 'Oops, ada yang terlewat!',
            text: 'Pastikan minimal 1 peserta. Mohon periksa kembali!',
            footer: `<a href='https://wa.me/${phone}' target='_blank'>Butuh bantuan?</a>`,  // Optional: A link to help page
            showConfirmButton: true,
            confirmButtonText: 'Periksa Kembali',
            confirmButtonColor: '#0d5aa5',
            customClass: {
                title: 'font-weight-bold', // Makes the title bold for emphasis
                content: 'font-italic',    // Optional: Adds italics to content
            },
            showCloseButton: true,  // Optional: Adds a close button
            didOpen: () => {
                // Optional: You can focus a specific element or scroll to it
                document.querySelector('input').focus();  // Focus on the first input
            }
        })
        return;
    }

    for (let i = 0; i < nik.length; i++) {
        if (nik[i] === '' || gender[i] === '' || hubunganEmergency[i] === '' || blood[i] === '' || jersey[i] === '') {
            isValid = false;
            break;  // Exit loop on first invalid select
        }
    }

    // If validation failed, show an error
    if (!isValid) {
        Swal.fire({
            icon: 'error',
            title: 'Oops, ada yang terlewat!',
            text: 'Pastikan semua kolom pada form telah diisi dengan benar. Mohon periksa kembali!',
            footer: `<a href='https://wa.me/${phone}' target='_blank'>Butuh bantuan?</a>`,  // Optional: A link to help page
            showConfirmButton: true,
            confirmButtonText: 'Periksa Kembali',
            confirmButtonColor: '#0d5aa5',
            customClass: {
                title: 'font-weight-bold', // Makes the title bold for emphasis
                content: 'font-italic',    // Optional: Adds italics to content
            },
            showCloseButton: true,  // Optional: Adds a close button
            didOpen: () => {
                // Optional: You can focus a specific element or scroll to it
                document.querySelector('input').focus();  // Focus on the first input
            }
        })
        return;
    }

    $.ajax({
        url: '/check-peserta',
        type: 'POST',
        data: {
            nik: nik, 
            type: 'komunitas', 
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            btn.attr('disabled', true);
            btn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>Loading ...</span>`);
        },
        success: function(response) {
            let data = response.data;

            if(response.status) {
                if(data.length > 0) {
                    // peserta sudah terdaftar tampilan modal konfirmasi override
                    let pesertaTerdaftar = '';

                    data.forEach((item, index) => {
                        pesertaTerdaftar += `${item.nama}, `;
                    });

                    // remove last comma
                    pesertaTerdaftar = pesertaTerdaftar.slice(0, -2);

                    openModalOverride(pesertaTerdaftar, 'processRegisterKomunitas()');
                } else {
                    processRegisterKomunitas();
                }
            }
        },
        error: function(error) {
            btn.attr('disabled', false);
            btn.html('Register');
            console.log(error);

            openModalError();
        }
    });

});

function processRegisterKomunitas() {

    var btn = $('#btn-submit-komunitas');

    console.log('Process Komunitas');

    let formData = new FormData($('#registerKomunitas')[0]);
        formData.append('type', 'komunitas');

    $.ajax({
        url: '/register-peserta',
        type : "POST",
        dataType : "JSON",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if(response.status) {
                closeModalOverride();
                openModal();
            }
            btn.attr('disabled', false);
            btn.html('Register');
        },
        error: function(error) {
            console.log(error);
            btn.attr('disabled', false);
            btn.html('Register');

            openModalError();
        }
    });
}
