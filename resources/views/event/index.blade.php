@extends('layouts.master')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">{{ $title }}</h3>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                @can("crudAccess", "EVENT")
                                <a href="/admin/event/form" class="btn btn-theme-custome btn-sm"><em class="icon ni ni-plus"></em><span>Add Data</span></a>
                                <hr class="preview-hr">
                                @endcan

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="form-label">Filter Tanggal</label>
                                        <div class="form-control-wrap">
                                            <div class="input-daterange date-picker-range input-group">
                                                <input type="text" class="form-control" name="start_date" id="start_date" value="{{ date('01/m/Y') }}" readonly /> 
                                                <div class="input-group-addon">TO</div>
                                                <input type="text" class="form-control" name="end_date" id="end_date" value="{{ date('d/m/Y') }}" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-2 d-flex align-items-center">
                                        <button type="button" class="btn btn-info" id="btn-filter"><em class="icon ni ni-search"></em><span>Filter</span></button>
                                    </div>
                                </div>

                                <hr class="preview-hr">

                                <table class="table table-striped nowrap" id="dt-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th> 
                                            <th>Tanggal</th> 
                                            <th>Lokasi</th> 
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Status</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalDetail">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Detail Event</h5>
            </div>
            <div class="modal-body">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="nama" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="tanggal" data-date-format="dd/mm/yyyy" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Lokasi</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="lokasi" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Jarak</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="jarak" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="deskripsi" rows="5" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Nama Rekening</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="nama_rekening" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Nomor Rekening</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="nomor_rekening" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Bank</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="bank" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Tanggal Mulai Tiket</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="tanggal_mulai_tiket" data-date-format="dd/mm/yyyy" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Tanggal Selesai Tiket</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="tanggal_selesai_tiket" data-date-format="dd/mm/yyyy" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Harga</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control text-end" id="harga" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Stok</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control text-end" id="stok" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection