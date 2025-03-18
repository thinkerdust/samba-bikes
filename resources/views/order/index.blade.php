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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Filter Tanggal</label>
                                            <div class="form-control-wrap">
                                                <div class="input-daterange date-picker-range input-group">
                                                    <input type="text" class="form-control" name="filter_start_date" id="filter_start_date" value="{{ date('01/m/Y') }}" readonly /> 
                                                    <div class="input-group-addon">TO</div>
                                                    <input type="text" class="form-control" name="filter_end_date" id="filter_end_date" value="{{ date('d/m/Y') }}" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Event</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select form-control form-control-lg select2-js event" id="filter_event" name="filter_event"></select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2" style="margin-top:30px">
                                        <button type="button" class="btn btn-info" id="btn-filter"><em class="icon ni ni-search"></em><span>Filter</span></button>
                                    </div>
                                </div>

                                <hr class="preview-hr">

                                <table class="table table-striped nowrap" id="dt-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Event</th> 
                                            <th>Nomor Order</th> 
                                            <th>Jumlah</th> 
                                            <th>Total Harga</th> 
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
                <h5 class="modal-title">Detail Order</h5>
            </div>
            <div class="modal-body">

                <table class="table table-striped nowrap" id="dt-table-detail">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Order</th>
                            <th>Peserta</th>
                            <th>Ukuran Jersey</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalKonfirmasi">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Order</h5>
            </div>

            <form class="form-validate is-alter" id="form-data">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="id_order" id="id_order">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Total Bayar</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="total_bayar" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="form-label">Tanggal Bayar</label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control" name="tgl_bayar" id="tgl_bayar" required>
                            </div>
                        </div>
                    </div>
                        

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-submit">Konfirmasi</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection