$(document).ready(function() {
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

    $('.format-number').keyup(function() {
        $(this).val(function (index, value) {
          return value.replace(/\D/g, "");
        });
    });

    $('#bank').select2({
        placeholder: 'Pilih Bank',
        ajax: {
            url: '/admin/data-bank',
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
    })

    // ID Event
    let id = $('#id').val();
    if(id) {
        $.ajax({
            url: '/admin/event/edit/'+id,
            dataType: 'json',
            success: function(response) {
                let data = response.data;
                if(data) {
                    $('#nama').val(data.nama);
                    $('#phone').val(data.phone);
                    $('#email').val(data.email);
                    $('#nama_rekening').val(data.nama_rekening);
                    $('#nomor_rekening').val(data.nomor_rekening);
                    $('#lokasi').val(data.lokasi);
                    $('#tanggal').datepicker('setDate', data.tanggal);
                    $('#deskripsi').val(data.deskripsi);
                    $('#tanggal_mulai_tiket').datepicker('setDate', data.tanggal_mulai);
                    $('#tanggal_selesai_tiket').datepicker('setDate', data.tanggal_selesai);
                    $('#harga').val(thousandView(data.harga));
                    $('#stok').val(thousandView(data.stok));
                    $("#bank").empty().append(`<option value="${data.bank}">${data.bank}</option>`).val(data.bank).trigger('change');

                    let link_storage = '/storage/uploads/';

                    if(data.banner) {
                        $('#preview_image_banner').attr('src', link_storage+data.banner);
                        $('#sectionBanner').html(`<a target="_blank" href="${link_storage+data.banner}" class="btn btn-info btn-sm">Link File Banner</a>`);
                        $('#old_banner').val(data.banner);
                    }

                    if(data.size_chart) {
                        $('#preview_image_size_chart').attr('src', link_storage+data.size_chart);
                        $('#sectionSizeChart').html(`<a target="_blank" href="${link_storage+data.size_chart}" class="btn btn-info btn-sm">Link File Size Chart</a>`);
                        $('#old_size_chart').val(data.size_chart);
                    }

                    if(data.rute) {
                        $('#preview_image_rute').attr('src', link_storage+data.rute);
                        $('#sectionRute').html(`<a target="_blank" href="${link_storage+data.rute}" class="btn btn-info btn-sm">Link File Rute</a>`);
                        $('#old_rute').val(data.rute);
                    }
                }
            },
            error: function(error) {
                console.log(error)
                NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
            }
        })
    }

    $('#form-data').submit(function(e) {
        e.preventDefault();
        formData = new FormData($(this)[0]);
        var btn = $('#btn-submit');

        $.ajax({
            url : "/admin/event/store",  
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
                    setTimeout(function(){
                        window.location.href = '/admin/event';
                    }, 2000)
                }else{
                    NioApp.Toast(response.message, 'warning', {position: 'top-right'});
                }
                btn.attr('disabled', false);
                btn.html('Save');
            },
            error: function(error) {
                console.log(error)
                btn.attr('disabled', false);
                btn.html('Save');
                NioApp.Toast('Error while fetching data', 'error', {position: 'top-right'});
            }
        });
    });

    NioApp.Dropzone('.upload-sponsor', {
        maxFilesize: 2, // MB
        acceptedFiles: "image/*",
        headers: { 'X-CSRF-TOKEN': token },
        url: "/admin/event/sponsor/store",
    
        success(file, response) {
            NioApp.Toast(response.message, 'success', { position: 'top-right' });
            file.serverId = response.data;
            this.checkFiles(); // Call checkFiles() properly
        },
    
        error(file, response) {
            this.removeFile(file);
            console.error("Upload Error:", response);
            NioApp.Toast(response, 'error', { position: 'top-right' });
        },
    
        init() {
            const dropzoneInstance = this;
            const dzMessage = document.querySelector('.upload-sponsor .dz-message');
    
            // **Define checkFiles as a method inside init**
            this.checkFiles = function () {
                if (dropzoneInstance.files.length > 0) {
                    dzMessage.style.display = 'none'; // Hide message
                } else {
                    dzMessage.style.display = 'block'; // Show message
                }
            };
    
            // Load existing files when editing
            fetch('/admin/event/sponsor/list/' + id)
                .then(response => response.json())
                .then(files => {
                    if (files.data && Array.isArray(files.data)) {
                        files.data.forEach(fileData => {
                            const existingFile = dropzoneInstance.files.find(f => f.serverId === fileData.id);
                            if (!existingFile) {
                                let mockFile = { 
                                    name: fileData.filename, 
                                    size: fileData.size, 
                                    serverId: fileData.id 
                                };
                                dropzoneInstance.emit("addedfile", mockFile);
                                dropzoneInstance.emit("thumbnail", mockFile, `/storage/uploads/${fileData.filename}`);
                                dropzoneInstance.emit("complete", mockFile);
    
                                // **Manually push to Dropzone's file array**
                                dropzoneInstance.files.push(mockFile);
                            }
                        });
                        dropzoneInstance.checkFiles(); // Update message after loading existing files
                    }
                })
                .catch(error => console.error("Error loading files:", error));
    
            this.on("addedfile", file => {
                dropzoneInstance.checkFiles();
    
                const removeButton = Dropzone.createElement("<button class='dz-remove btn btn-danger btn-sm'>Remove</button>");
    
                removeButton.addEventListener("click", async (e) => {
                    e.preventDefault();
                    e.stopPropagation();
    
                    if (file.serverId) {
                        try {
                            const response = await fetch(`/admin/event/sponsor/delete/${file.serverId}`, {
                                method: "DELETE",
                                headers: { 'X-CSRF-TOKEN': token }
                            });
                            const data = await response.json();
    
                            if (data.status) {
                                dropzoneInstance.removeFile(file);
                                NioApp.Toast(data.message, 'success', { position: 'top-right' });
                            } else {
                                NioApp.Toast("Failed to delete file.", 'error', { position: 'top-right' });
                            }
                        } catch (error) {
                            console.error("Delete Error:", error);
                        }
                    } else {
                        dropzoneInstance.removeFile(file);
                    }
                    dropzoneInstance.checkFiles();
                });
    
                file.previewElement.appendChild(removeButton);
            });
    
            this.on("removedfile", () => {
                dropzoneInstance.checkFiles();
            });
        }
    });
    
})

$('#preview_image_size_chart, #preview_image_rute, #preview_image_banner1, #preview_image_banner2, #preview_image_banner3').attr('src', "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.png");

$('#banner1').on('change', function() {
    handleFileChange('banner1', 'preview_image_banner1', 'label_banner1');
});

$('#banner2').on('change', function() {
    handleFileChange('banner2', 'preview_image_banner2', 'label_banner2');
});

$('#banner3').on('change', function() {
    handleFileChange('banner3', 'preview_image_banner3', 'label_banner3');
});

$('#size_chart').on('change', function() {
    handleFileChange('size_chart', 'preview_image_size_chart', 'label_size_chart');
});

$('#rute').on('change', function() {
    handleFileChange('rute', 'preview_image_rute', 'label_rute');
});

const handleFileChange = (inputId, previewId, labelId) => {
    var maxSizeMb = 2;
    var fileInput = $('#' + inputId)[0];
    var file = fileInput.files[0];
    var defaultImage = "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.png";

    if (file) {
        var totalSizeMb = file.size / Math.pow(1024, 2);

        if (totalSizeMb > maxSizeMb) {
            NioApp.Toast(`File too large. Maximum file size is ${maxSizeMb} MB. Selected file is ${totalSizeMb.toFixed(2)} MB`, 'warning', { position: 'top-right' });
            
            $('#' + inputId).val('');
            $('#' + previewId).attr('src', defaultImage);
            $('#' + labelId).html('Choose file');
        } else {
            $('#' + labelId).html(file.name);
            readURL(fileInput, previewId);
        }
    }
}

const readURL = (input,el) => {
    if (input.files && input.files[0]) {
        const reader = new FileReader()
        reader.onload = (e) => {
            $('#'+el).removeAttr('src')
            $('#'+el).attr('src', e.target.result)
        }
        reader.readAsDataURL(input.files[0])
    }
};