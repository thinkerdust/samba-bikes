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
                                @can("crudAccess", "ORDER")
                                <a href="" onclick="take_racepack()" class="toggle btn btn-theme-custome btn-sm"><em class="icon ni ni-plus"></em><span>Pengambilan Racepack</span></a>
                                <hr class="preview-hr">
                                @endcan
                                <input type="hidden" id="nomor" value="{{ $nomor }}">
                                <table class="table table-striped nowrap" id="dt-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="check_all">
                                                    <label class="custom-control-label" for="check_all"></label>
                                                </div>
                                            </th> 
                                            <th>Peserta</th> 
                                            <th>Size Jersey</th> 
                                            <th>Diambil Oleh</th> 
                                            <th>Waktu Pengambilan</th>
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

<div class="modal fade" tabindex="-1" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Form Pengambilan Racepack</h5>
            </div>

            <form class="form-validate is-alter" id="form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_order_detail" id="id_order_detail">
                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control date-picker" id="tanggal" name="tanggal" data-date-format="dd/mm/yyyy" value="{{ date('d/m/Y') }}" readonly required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-submit">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection