@extends('layouts.master')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">{{ $title }}</h2>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <form class="form-validate is-alter" id="form-data" autocomplete="off">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ isset($id) ? $id:0 }}">

                                        <h3>Data Event</h3>
                                        <div class="row gy-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Tour De Borobudur 2025" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control format-number" id="phone" name="phone" placeholder="085123456789" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="email" class="form-control" id="email" name="email" placeholder="samba@gmail.com" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control date-picker" id="tanggal" name="tanggal" data-date-format="dd/mm/yyyy" placeholder="10/04/2025" readonly required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="form-label">Kota <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="kota" name="kota" oninput="this.value = this.value.toUpperCase();" placeholder="SEMARANG" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="form-label">Jarak (KM) <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" id="jarak" name="jarak" placeholder="50" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="form-label">Lokasi / Alamat <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Jl. Jangli dalam 2, RT.04 RW.05 Kecamatan Semarang Tengah, Semarang, Indonesia" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Tanggal Racepack <span class="text-danger">*</span></label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control date-picker" id="tanggal_racepack" name="tanggal_racepack" data-date-format="dd/mm/yyyy" placeholder="10/04/2025" readonly required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label d-none d-xxl-block">Jam Mulai Racepack <span class="text-danger">*</span></label>
                                                            <label class="form-label d-block d-xxl-none">Mulai Racepack <span class="text-danger">*</span></label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control text-center" id="jam_mulai_racepack" name="jam_mulai_racepack" placeholder="__:__" maxlength="5" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label d-none d-xxl-block">Jam Selesai Racepack <span class="text-danger">*</span></label>
                                                            <label class="form-label d-block d-xxl-none">Selesai Racepack <span class="text-danger">*</span></label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control text-center" id="jam_selesai_racepack" name="jam_selesai_racepack" placeholder="__:__" maxlength="5" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Latitude Start</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="lat_start" name="lat_start" placeholder="-6.983279655865463">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Longitude Start</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="long_start" name="long_start" placeholder="110.44557770717617">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Deskripsi (What We Do)</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" placeholder="Isi Dengan Deskripsi Event"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Link Rute <span class="text-danger">* Wajib diisi jika gambar/file rute tidak ada</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="link_rute" name="link_rute" placeholder="https://www.google.com/maps">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Bank <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-control" name="bank" id="bank" required></select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Nama Rekening <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" placeholder="Elon Musk" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control format-number" id="nomor_rekening" name="nomor_rekening" placeholder="1234567890" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Tanggal Start Tiket <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control date-picker" id="tanggal_mulai_tiket" name="tanggal_mulai_tiket" data-date-format="dd/mm/yyyy" placeholder="10/04/2025" readonly required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Tanggal End Tiket <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control date-picker" id="tanggal_selesai_tiket" name="tanggal_selesai_tiket" data-date-format="dd/mm/yyyy" placeholder="12/04/2025" readonly required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Harga <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control format-currency text-end" id="harga" name="harga" placeholder="200.000" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control format-currency text-end" id="stok" name="stok" placeholder="100" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Latitude End</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="lat_end" name="lat_end" placeholder="-6.983279655865463">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Longitude End</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="long_end" name="long_end" placeholder="110.44557770717617">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Deskripsi (Internal)</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control" id="deskripsi_internal" name="deskripsi_internal" rows="5" placeholder="Isi Dengan Deskripsi Internal"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="preview-hr">
                                        <h3>Sosial Media</h3>
                                        <div class="row gy-4">
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Facebook</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Isi Akun Facebook">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Twitter</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Isi Akun Twitter">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Instagram</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Isi Akun Instagram">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Youtube</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="youtube" name="youtube" placeholder="Isi Akun Youtube">
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="preview-hr">
                                        <h3>Assets</h3>
                                        <div class="row gy-4">
                                            <div class="col-md-4">
                                                <label class="form-label">File Banner 1 <span class="text-danger">*</span></label>
                                                    <label class="cabinet center-block">
                                                    <figure>
                                                        <img src="" class="gambar img-responsive img-thumbnail" id="preview_image_banner1" />
                                                        <figcaption>
                                                            <ul>
                                                                <li>*)Leave blank if you don't want to replace</li>
                                                                <li>*)Max size file 2 MB</li>
                                                            </ul>
                                                        </figcaption>
                                                    </figure>
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input" id="banner1" name="banner1" accept=".png, .jpg">
                                                            <input type="hidden" id="old_banner1" name="old_banner1">
                                                            <label class="form-file-label" id="label_banner1" for="banner1">Choose file</label>
                                                        </div>
                                                        <div class="d-flex align-items-center my-2">
                                                            <a target="_blank" href="{{ asset('assets/images/DEFAULT-LANDING.png') }}" class="btn btn-primary btn-sm me-2 d-none d-xxl-block">Download Default Banner</a>
                                                            <a target="_blank" href="{{ asset('assets/images/DEFAULT-LANDING.png') }}" class="btn btn-primary btn-sm me-2 d-block d-xxl-none">Default Banner</a>
                                                            <div id="sectionBanner1" class="my-2"></div>
                                                        </div>
                                                    </div>
                                                </label>
                                                <div class="form-group">
                                                    <label class="form-label">Tagline Banner 1 <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="tagline_banner1" name="tagline_banner1" placeholder="Feel Your Burn" required>
                                                        <div class="invalid-feedback">
                                                            Tagline must be a maximum of 4 words.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">File Banner 2</label>
                                                    <label class="cabinet center-block">
                                                    <figure>
                                                        <img src="" class="gambar img-responsive img-thumbnail" id="preview_image_banner2" />
                                                        <figcaption>
                                                            <ul>
                                                                <li>*)Leave blank if you don't want to replace</li>
                                                                <li>*)Max size file 2 MB</li>
                                                            </ul>
                                                        </figcaption>
                                                    </figure>
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input" id="banner2" name="banner2" accept=".png, .jpg">
                                                            <input type="hidden" id="old_banner2" name="old_banner2">
                                                            <label class="form-file-label" id="label_banner2" for="banner2">Choose file</label>
                                                        </div>
                                                        <div id="sectionBanner2" class="my-2"></div>
                                                    </div>
                                                </label>
                                                <div class="form-group">
                                                    <label class="form-label">Tagline Banner 2</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="tagline_banner2" placeholder="Feel Your Muscle" name="tagline_banner2">
                                                        <div class="invalid-feedback">
                                                            Tagline must be a maximum of 4 words.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">File Banner 3</label>
                                                    <label class="cabinet center-block">
                                                    <figure>
                                                        <img src="" class="gambar img-responsive img-thumbnail" id="preview_image_banner3" />
                                                        <figcaption>
                                                            <ul>
                                                                <li>*)Leave blank if you don't want to replace</li>
                                                                <li>*)Max size file 2 MB</li>
                                                            </ul>
                                                        </figcaption>
                                                    </figure>
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input" id="banner3" name="banner3" accept=".png, .jpg">
                                                            <input type="hidden" id="old_banner3" name="old_banner3">
                                                            <label class="form-file-label" id="label_banner3" for="banner3">Choose file</label>
                                                        </div>
                                                        <div id="sectionBanner3" class="my-2"></div>
                                                    </div>
                                                </label>
                                                <div class="form-group">
                                                    <label class="form-label">Tagline Banner 3</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="tagline_banner3" placeholder="Feel Your Turn" name="tagline_banner3">
                                                        <div class="invalid-feedback">
                                                            Tagline must be a maximum of 4 words.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">File Size Chart <span class="text-danger">*</span></label>
                                                    <label class="cabinet center-block">
                                                    <figure>
                                                        <img src="" class="gambar img-responsive img-thumbnail" id="preview_image_size_chart" />
                                                        <figcaption>
                                                            <ul>
                                                                <li>*)Leave blank if you don't want to replace</li>
                                                                <li>*)Max size file 2 MB</li>
                                                            </ul>
                                                        </figcaption>
                                                    </figure>
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input" id="size_chart" name="size_chart" accept=".png, .jpg">
                                                            <input type="hidden" id="old_size_chart" name="old_size_chart">
                                                            <label class="form-file-label" id="label_size_chart" for="size_chart">Choose file</label>
                                                        </div>
                                                        <div id="sectionSizeChart" class="my-2"></div>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">File Rute <span class="text-danger">*</span></label>
                                                    <label class="cabinet center-block">
                                                    <figure>
                                                        <img src="" class="gambar img-responsive img-thumbnail" id="preview_image_rute" />
                                                        <figcaption>
                                                            <ul>
                                                                <li>*)Leave blank if you don't want to replace</li>
                                                                <li>*)Max size file 2 MB</li>
                                                            </ul>
                                                        </figcaption>
                                                    </figure>
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input" id="rute" name="rute" accept=".png, .jpg">
                                                            <input type="hidden" id="old_rute" name="old_rute">
                                                            <label class="form-file-label" id="label_rute" for="rute">Choose file</label>
                                                        </div>
                                                        <div id="sectionRute" class="my-2"></div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        @if (isset($id))    
                                            <hr class="preview-hr">
                                            <h3>Event Schedule</h3>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Nama Schedule <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="hidden" id="id_schedule" name="id_schedule">
                                                            <input type="text" class="form-control" id="nama_schedule" name="nama_schedule" placeholder="Opening Ceremony & Warm-up">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xxl-7">
                                                    <div class="form-group">
                                                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="deskripsi_schedule" name="deskripsi_schedule" placeholder="Kick off the event with an energizing warm-up session, race briefing, and an inspiring welcome speech.">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-xxl-1">
                                                    <div class="form-group">
                                                        <label class="form-label">Jam <span class="text-danger">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control text-center" id="jam_schedule" name="jam_schedule" placeholder="__:__" maxlength="5">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1" style="margin-top: 30px">
                                                    <button type="button" class="btn btn-primary text-sm" id="btn-submit-event-schedule">
                                                        <span class="block d-block d-xxl-none"><i class="fas fa-plus"></i></span>
                                                        <span class="hidden d-none d-xxl-block">Tambah</span>
                                                    </button>                                              
                                                </div>

                                                <table class="table table-striped nowrap" id="dt-table-schedule">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Schedule</th> 
                                                            <th>Deskripsi</th> 
                                                            <th>Jam</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                
                                                </table>

                                            </div>

                                            <hr class="preview-hr">
                                            <h3>Sponsorship</h3>
                                            <div class="upload-sponsor" id="upload-sponsor">
                                                <div class="dz-message" data-dz-message>
                                                    <span class="dz-message-text">Drag and drop file</span>
                                                    <span class="dz-message-or">or</span>
                                                    <button type="button" class="btn btn-primary">SELECT</button>
                                                </div>
                                            </div>

                                            <hr class="preview-hr">
                                            <h3>Event Images</h3>
                                            <div class="upload-event-image" id="upload-event-image">
                                                <div class="dz-message" data-dz-message>
                                                    <span class="dz-message-text">Drag and drop file</span>
                                                    <span class="dz-message-or">or</span>
                                                    <button type="button" class="btn btn-primary">SELECT</button>
                                                </div>
                                            </div>
                                        @endif

                                        <hr class="preview-hr">
                                        <button type="submit" class="btn btn-theme-custome" id="btn-submit">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div><!-- .nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    label.cabinet{
        display: block;
        cursor: pointer;
    }

    label.cabinet input.file{
        position: relative;
        height: 100%;
        width: auto;
        opacity: 0;
        -moz-opacity: 0;
        filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
        margin-top:-30px;
    }

    .form-file-label {
        white-space: nowrap;
        overflow: hidden;
    }

    .gambar {
        width: 200px;
        height: 200px;
        object-fit: cover;
        object-position: 50% 0;
    }

    .dz-remove {
        width: 100%;
        margin-top: 1rem;
        border-radius: 25px;
    }
    
</style>

@endsection