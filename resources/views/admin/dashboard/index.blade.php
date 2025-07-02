@extends('layouts.admin.template')
@section('title', 'Dashboard')
@section('content')
    <div class="row g-6">

        <!-- Welcome -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="d-flex align-items-center g-5 row" style="height: 315px">
                    <div class="col-7">
                        <div class="card-body text-nowrap d-flex flex-column gap-4">
                            <h5 class="card-title mb-0">Selamat datang kembali!</h5>
                            <p class="text-primary mb-2">🎉🎉 {{ \Auth::user()->name }} 🎉🎉</p>
                            <p class="text-muted mb-0 text-wrap">Semoga harimu penuh keberkahan dan dimudahkan dalam setiap
                                langkah 🤲
                            </p>
                        </div>

                    </div>
                    <div class="col-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('admin') }}/assets/img/illustrations/card-advance-sale.png" height="140"
                                alt="view sales" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Welcome -->

    </div>
@endsection
