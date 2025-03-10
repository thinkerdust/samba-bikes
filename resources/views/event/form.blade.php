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
                                        <input type="hidden" name="kode" id="kode" value="{{ isset($kode) ? $kode:0 }}">
                                        <div class="row gy-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nama</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Lokasi</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control date-picker" id="tanggal" name="tanggal" data-date-format="dd/mm/yyyy" readonly required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Deskripsi</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Mulai Tiket</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control date-picker" id="tanggal_mulai_tiket" name="tanggal_mulai_tiket" data-date-format="dd/mm/yyyy" readonly required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Selesai Tiket</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control date-picker" id="tanggal_selesai_tiket" name="tanggal_selesai_tiket" data-date-format="dd/mm/yyyy" readonly required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Harga</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control format-currency text-end" id="harga" name="harga" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Stok</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control format-currency text-end" id="stok" name="stok" required>
                                                    </div>
                                                </div>
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
@endsection