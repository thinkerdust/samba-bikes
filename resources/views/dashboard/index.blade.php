@extends('layouts.master')

@section('content')

<style>
    .card {
        box-shadow: 0 6px 12px rgba(255, 214, 10, 0.12);
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(255, 214, 10, 0.2);
        cursor: pointer;
    }

    .card-icon i {
        color: #facc15;
        font-size: 2em;
    }

    @media (min-width: 1400px) {
        .card-icon i {
            font-size: 3em;
        }
    }
</style>

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Welcome, {{ ucwords(Auth::user()->name) }}</h3>
                        </div><!-- .nk-block-head-content -->
                        
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->

                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-xxl-6 col-sm-6">
                            <div class="card" data-target="{{ route('peserta') }}">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Total Peserta</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount" id="total-peserta">0</div>
                                                <div class="card-icon pe-1 pe-md-4">
                                                    <i class="fas fa-user-friends"></i>
                                                </div>
                                            </div>
                                            <small class="desc">Jumlah seluruh peserta yang telah terdaftar dalam event.</small>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-xxl-6 col-sm-6">
                            <div class="card" data-target="{{ route('peserta') }}">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Total Komunitas</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount" id="total-komunitas">0</div>
                                                <div class="card-icon pe-1 pe-md-4">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <small class="text-muted">Total komunitas atau grup yang bergabung dan berpartisipasi dalam event.</small>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-xxl-6 col-sm-6">
                            <div class="card" data-target="{{ route('order') }}">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Total Order</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount" id="total-order">0</div>
                                                <div class="card-icon pe-1 pe-md-4">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </div>
                                            </div>
                                            <small class="text-muted">Jumlah seluruh pesanan yang telah dilakukan oleh peserta atau komunitas.</small>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-xxl-6 col-sm-6">
                            <div class="card" data-target="{{ route('order') }}">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Total Revenue</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount" id="total-revenue">0</div>
                                                <div class="card-icon pe-1 pe-md-4">
                                                    <i class="fas fa-coins"></i>
                                                </div>
                                            </div>
                                            <small class="text-muted">Total pendapatan yang dihasilkan dari seluruh transaksi yang telah berhasil.</small>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
                
            </div>
        </div>
    </div>
</div>
@endsection