@extends('layouts.user_dashboard')

@section('title',"Lihat Guru")

@php
    /** @var \App\User[]|\App\UserData[]|\App\UserStatus[] $data */
@endphp

@section('css')

@endsection

@section('content')
    <main>
        <div class="section-area">
            <div class="jumbotron jumbotron-fluid jumbotron-profile">
                <img src="dist/assets/img/banner-1.jpg" class="img-fluid" style="width: 100%;">
            </div>
        </div>
        <section class="teacher-profile">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card mb-4">
                            <div class="card-body pb-0">
                                <div class="row mb-2">
                                    <div class="col-12 col-lg-12 d-flex justify-content-between">
                                        <div class="row">
                                            <div class="col-12 col-lg-9 mb-sm-3 d-flex justify-content-start align-items-center">
                                                <img src="dist/assets/img/user-1.jpg" class="teacher-image rounded-circle mr-3" width="120px" height="120px" style="border: 5px solid #DDD;">
                                                <div class="teacher-description">
                                                    <h5 class="mb-0">
                                                        <strong>
                                                            Titin Supriati
                                                        </strong>
                                                    </h5>
                                                    <small class="text-muted">Guru Bahasa Indonesia</small>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fas fa-map-marker-alt"></i> Gubeng - Surabaya
                                                    </small>
                                                    <br>
                                                    <div class="rating">
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star"></i>
                                                        <small>(10)</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-3 d-flex justify-content-start justify-content-sm-center align-items-center">
                                                <a href="chat-guru.html" class="btn btn-xs btn-default mr-3">
                                                    <i class="fas fa-comment-dots"></i> Kirim Pesan
                                                </a>
                                                <a href="dashboard-guru.html" class="btn btn-xs btn-secondary">
                                                    <i class="fas fa-pencil-alt"></i> Edit Profile
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="menu-profile">
                                        <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">
                                                    Tentang Guru
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="schedule" aria-selected="true">
                                                    Jadwal Guru
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="mb-0">
                                                            <strong>
                                                                Informasi Pribadi
                                                            </strong>
                                                        </h6>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="profile-info d-flex justify-content-start align-items-start">
                                                            <i class="fas fa-birthday-cake icon-lg text-muted mr-3"></i>
                                                            <div>
                                                                <p class="text-muted mb-1 mr-3">
                                                                    Tanggal Lahir
                                                                </p>
                                                                <p class="font-weight-bold mb-0">
                                                                    17 Agustus 1997
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info d-flex justify-content-start align-items-start">
                                                            <i class="fas fa-transgender icon-lg text-muted mr-3"></i>
                                                            <div>
                                                                <p class="text-muted mb-1 mr-3">
                                                                    Jenis Kelamin
                                                                </p>
                                                                <p class="font-weight-bold mb-0">
                                                                    Perempuan
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info d-flex justify-content-start align-items-start">
                                                            <i class="fas fa-phone icon-lg text-muted mr-3"></i>
                                                            <div>
                                                                <p class="text-muted mb-1 mr-3">
                                                                    Nomor Handphone
                                                                </p>
                                                                <p class="font-weight-bold mb-0">
                                                                    0821392187312
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info d-flex justify-content-start align-items-start">
                                                            <i class="far fa-envelope icon-lg text-muted mr-3"></i>
                                                            <div>
                                                                <p class="text-muted mb-1 mr-3">
                                                                    Email
                                                                </p>
                                                                <p class="font-weight-bold mb-0">
                                                                    guru@email.com
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-8">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="mb-0">
                                                            <strong>
                                                                Siswa
                                                            </strong>
                                                        </h6>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-4 pr-lg-0">
                                                                <div class="profile-info d-flex justify-content-start align-items-start">
                                                                    <i class="fas fa-users icon-lg text-muted mr-3"></i>
                                                                    <div>
                                                                        <p class="text-muted mb-1 mr-3">
                                                                            Total Siswa
                                                                        </p>
                                                                        <p class="font-weight-bold mb-0">
                                                                            100 Siswa
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-4 px-lg-0">
                                                                <div class="profile-info d-flex justify-content-start align-items-start">
                                                                    <i class="fas fa-graduation-cap icon-lg text-muted mr-3"></i>
                                                                    <div>
                                                                        <p class="text-muted mb-1 mr-3">
                                                                            Siswa Lulus
                                                                        </p>
                                                                        <p class="font-weight-bold mb-0">
                                                                            90 Siswa
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-4 pl-lg-0">
                                                                <div class="profile-info d-flex justify-content-start align-items-start">
                                                                    <i class="fas fa-graduation-cap icon-lg text-muted mr-3"></i>
                                                                    <div>
                                                                        <p class="text-muted mb-1 mr-3">
                                                                            Rating Siswa
                                                                        </p>
                                                                        <p class="font-weight-bold mb-0">
                                                                            90/100 Siswa
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show active" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="mb-0">
                                                            <strong>
                                                                Senin
                                                            </strong>
                                                        </h6>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="profile-info d-flex justify-content-start align-items-start">
                                                            <p class="text-muted mb-1 mr-3">
                                                                18.00 - 19.00
                                                            </p>
                                                            <p class="font-weight-bold mb-0">
                                                                Bahasa Indonesia
                                                            </p>
                                                        </div>
                                                        <div class="profile-info d-flex justify-content-start align-items-start">
                                                            <p class="text-muted mb-1 mr-3">
                                                                19.00 - 20.00
                                                            </p>
                                                            <p class="font-weight-bold mb-0">
                                                                Bahasa Indonesia
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="mb-0">
                                                            <strong>
                                                                Rabu
                                                            </strong>
                                                        </h6>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="profile-info d-flex justify-content-start align-items-start">
                                                            <p class="text-muted mb-1 mr-3">
                                                                18.00 - 19.00
                                                            </p>
                                                            <p class="font-weight-bold mb-0">
                                                                Bahasa Indonesia
                                                            </p>
                                                        </div>
                                                        <div class="profile-info d-flex justify-content-start align-items-start">
                                                            <p class="text-muted mb-1 mr-3">
                                                                19.00 - 20.00
                                                            </p>
                                                            <p class="font-weight-bold mb-0">
                                                                Bahasa Indonesia
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="mb-0">
                                                            <strong>
                                                                Jumat
                                                            </strong>
                                                        </h6>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="profile-info d-flex justify-content-start align-items-start">
                                                            <p class="text-muted mb-1 mr-3">
                                                                18.00 - 19.00
                                                            </p>
                                                            <p class="font-weight-bold mb-0">
                                                                Bahasa Indonesia
                                                            </p>
                                                        </div>
                                                        <div class="profile-info d-flex justify-content-start align-items-start">
                                                            <p class="text-muted mb-1 mr-3">
                                                                19.00 - 20.00
                                                            </p>
                                                            <p class="font-weight-bold mb-0">
                                                                Bahasa Indonesia
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('landing.footer')
    </main>
@endsection

@section('js')
@endsection