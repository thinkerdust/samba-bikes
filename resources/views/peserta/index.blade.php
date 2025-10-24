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

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="form-label">Event</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select form-control form-control-lg select2-js event" id="filter_event"></select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="form-label">Status</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select form-control form-control-lg select2-js status" id="filter_status" name="filter_status">
                                                <option value="all">Semua</option>
                                                <option value="1">Pending</option>
                                                <option value="2" selected>Paid</option>
                                                <option value="0">Deleted</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-2 d-flex align-items-center">
                                        <button type="button" class="btn btn-info" id="btn-filter"><em class="icon ni ni-search"></em><span>Filter</span></button>
                                    </div>

                                    <div class="col-md-2 mt-2 d-flex align-items-center">
                                        <button type="button" class="btn btn-success" id="btn-export"><em class="icon ni ni-file-xls"></em><span>Export Data</span></button>
                                    </div>
                                </div>

                                <hr class="preview-hr">

                                <table class="table table-striped nowrap" id="dt-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Event</th>
                                            <th>Nama Komunitas</th> 
                                            <th>Nama</th> 
                                            <th>Gender</th>
                                            <th>Phone</th> 
                                            <th>Emergency Phone</th>
                                            <th>Emergency Hubungan</th>
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

<div class="modal fade" tabindex="-1" id="modalDetailEdit">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Detail / Edit Peserta</h5>
            </div>

            <form class="form-validate is-alter" id="form-data">
                @csrf
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="id_komunitas" id="id_komunitas">
                <input type="hidden" name="nomor_order" id="nomor_order">

                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Komunitas</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="nama_komunitas" name="nama_komunitas">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nomor</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nomor Darurat</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="telp_emergency" name="telp_emergency">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Hubungan Darurat</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="hubungan_emergency" name="hubungan_emergency">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">NIK</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="nik" name="nik">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kota</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="kota" name="kota">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" data-date-format="dd/mm/yyyy">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Gol Darah</label>
                            <div class="form-control-wrap">
                                <select name="blood" id="blood" class="form-control select2-js">
                                    <option value="">- Golongan Darah -</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="form-control-wrap">
                                <select name="gender" id="gender" class="form-control select2-js">
                                    <option value="">- Jenis Kelamin -</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jersey (Size Jersey)</label>
                            <div class="form-control-wrap">
                                <select name="size_jersey" id="size_jersey" class="form-control select2-size-chart"></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Alamat</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="alamat" name="alamat" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-theme-custome" id="btn-submit">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection