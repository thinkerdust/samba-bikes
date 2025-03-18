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
                                        <div class="row gy-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control format-number" id="phone" name="phone" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="email" class="form-control" id="email" name="email" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control date-picker" id="tanggal" name="tanggal" data-date-format="dd/mm/yyyy" readonly required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Bank <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-control" name="bank" id="bank" required></select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Nama Rekening <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control format-number" id="nomor_rekening" name="nomor_rekening" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Mulai Tiket <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control date-picker" id="tanggal_mulai_tiket" name="tanggal_mulai_tiket" data-date-format="dd/mm/yyyy" readonly required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Selesai Tiket <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control date-picker" id="tanggal_selesai_tiket" name="tanggal_selesai_tiket" data-date-format="dd/mm/yyyy" readonly required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Harga <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control format-currency text-end" id="harga" name="harga" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control format-currency text-end" id="stok" name="stok" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Deskripsi</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <label class="form-label">File Banner <span class="text-danger">*</span></label>
                                                    <label class="cabinet center-block">
                                                    <figure>
                                                        <img src="" class="gambar img-responsive img-thumbnail" id="preview_image_banner" />
                                                        <figcaption>
                                                            <ul>
                                                                <li>*)Leave blank if you don't want to replace</li>
                                                                <li>*)Max size file 2 MB</li>
                                                            </ul>
                                                        </figcaption>
                                                    </figure>
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input" id="banner" name="banner" accept=".png, .jpg">
                                                            <input type="hidden" id="old_banner" name="old_banner">
                                                            <label class="form-file-label" id="label_banner" for="banner">Choose file</label>
                                                        </div>
                                                        <div id="sectionBanner" class="my-2"></div>
                                                    </div>
                                                </label>
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

    .gambar {
        width: 200px;
        height: 200px;
        object-fit: cover;
        object-position: 50% 0;
    }
</style>

@endsection