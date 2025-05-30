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
                                @can("crudAccess", "UM1")
                                <a href="#" onclick="tambah()" class="toggle btn btn-theme-custome btn-sm"><em class="icon ni ni-plus"></em><span>Add Data</span></a>
                                @endcan
                                <hr class="preview-hr">
                                <table class="table table-striped nowrap" id="dt-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th> 
                                            <th>Username</th> 
                                            <th>Email</th> 
                                            <th>Role</th>
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

<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Form User</h5>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="form-data">
                    @csrf
                    <input type="hidden" name="id_user" id="id_user">
                    <div class="form-group">
                        <label class="form-label">Nama</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="nama" id="nama" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <div class="form-control-wrap">
                            <select class="form-control" name="role" id="role" required></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Level</label>
                        <div class="form-control-wrap">
                            <select class="form-control js-select2" name="level" id="level" required>
                                <option value="">Pilih Level</option>
                                <option value="1">Superadmin</option>
                                <option value="2">Admin</option>
                                <option value="3">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <div class="form-control-wrap">
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="username" id="username" required>
                            <span class="ff-italic">Default Password : 5amba8ikes!</span>
                        </div>
                    </div>
                    
                    <hr class="preview-hr">
                    <button type="submit" class="btn btn-theme-custome" id="btn-submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .modal.show .select2-container {
        position: inherit !important;
    }
</style>
@endsection