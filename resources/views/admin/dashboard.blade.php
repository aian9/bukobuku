@extends("layouts.admin_dashboard")

@php
    /** @var \App\Order[] $order */
    /** @var \App\DataTransfer[] $dataTransfer */
@endphp

@section('title','Dashboard Admin')

@section('css')
@endsection

@section('content')
<main>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="status-card mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div class="">
                                        <h1 class="mb-3">@foreach($jumlah_siswa as $siswa)
                                            {{ $siswa->hitung }}
                                            @endforeach</h1>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>
                                                <h5 class="mb-0">Siswa</h5>
                                            </span>
                                            <i class="fa fa-users big-icon" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div class="">
                                        <h1 class="mb-3">@foreach($jumlah_guru as $guru)
                                            {{ $guru->hitung }}
                                            @endforeach</h1>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>
                                                <h5 class="mb-0">Guru</h5>
                                            </span>
                                            <i class="fas fa-chalkboard-teacher big-icon" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div class="">
                                        <h1 class="mb-3">@foreach($jumlah_pesanan as $pesanan)
                                            {{ $pesanan->hitung }}
                                            @endforeach</h1>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>
                                                <h5 class="mb-0">Jumlah Pesanan</h5>
                                            </span>
                                            <i class="fas fa-comments-dollar big-icon" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div class="">
                                        <h1 class="mb-3">@foreach($jumlah_selesai as $pesanan_selesai)
                                            {{ $pesanan_selesai->hitung }}
                                            @endforeach</h1>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>
                                                <h5 class="mb-0">Jumlah Pesanan Selesai</h5>
                                            </span>
                                            <i class="fas fa-check big-icon" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="statistics mb-3">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                <h4 class="card-title"><strong>Statistics</strong></h4>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    11 May 2018
                                    </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate">
                                        <a class="dropdown-item" href="#">12 May 2018</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">13 May 2018</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">14 May 2018</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">15 May 2018</a>
                                    </div>
                                </div>
                                </div>
                                <div id="statistics-legend" class="chartjs-legend mt-2 mb-4"></div>
                                <canvas id="statistics-chart"></canvas>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-3">
                                    <h4 class="card-title"><strong>User tickets</strong></h4>
                                    <div class="dropdown">
                                        <button class="btn bg-white p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fa fa-ellipsis-h text-primary"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                                            <a class="dropdown-item" href="#">Settings</a>
                                        <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Details</a>
                                        <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Export</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list">
                                    <div class="preview-item pt-0">
                                        <div class="preview-thumbnail">
                                            <img src="dist/assets/img/user-1.jpg" alt="image" class="img-profile">
                                        </div>
                                        <div class="preview-item-content flex-grow-1">
                                            <h6>Franklin Anderson</h6>
                                            <p class="text-muted font-weight-light mb-0">6 Powerful Tips To Creating Testimonials</p>
                                        </div>
                                    </div>
                                    <p class="mb-0">19 Jan 2018</p>
                                </div>
                                <div class="preview-list">
                                    <div class="preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="dist/assets/img/user-1.jpg" alt="image" class="img-profile">
                                        </div>
                                        <div class="preview-item-content flex-grow-1">
                                            <h6>Louise Horton</h6>
                                            <p class="text-muted font-weight-light mb-0">Research In Advertising</p>
                                        </div>
                                    </div>
                                    <p class="mb-0">27 Feb 2018</p>
                                </div>
                                <div class="preview-list">
                                    <div class="preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="dist/assets/img/user-1.jpg" alt="image" class="img-profile">
                                        </div>
                                        <div class="preview-item-content flex-grow-1">
                                            <h6>Eric Garcia</h6>
                                            <p class="text-muted font-weight-light mb-0">Create a successful adevertisement</p>
                                        </div>
                                    </div>
                                    <p class="mb-0">03 Feb 2018</p>
                                </div>
                                <div class="preview-list">
                                    <div class="preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="dist/assets/img/user-1.jpg" alt="image" class="img-profile">
                                        </div>
                                        <div class="preview-item-content flex-grow-1">
                                            <h6>Amy Cole</h6>
                                            <p class="text-muted font-weight-light mb-0">Why Do You Need To Join Marketing Network</p>
                                        </div>
                                    </div>
                                    <p class="mb-0">25 Sep 2018</p>
                                </div>
                                <div class="preview-list end">
                                    <div class="preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="dist/assets/img/user-1.jpg" alt="image" class="img-profile">
                                        </div>
                                        <div class="preview-item-content flex-grow-1">
                                            <h6>Russell Rodriquez</h6>
                                            <p class="text-muted font-weight-light mb-0">Effective Forms Of Advertising</p>
                                        </div>
                                    </div>
                                    <p class="mb-0">29 Sep 2018</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>Analysis</strong></h4>
                                <canvas id="analysis-chart"></canvas>                  
                                <div class="d-lg-flex justify-content-around mt-5">
                                    <div class="text-center mb-3 mb-lg-0">
                                        <h3 class="font-weight-light text-success">+40.02%</h3>
                                        <p class="text-muted mb-0">Growth</p>
                                    </div>
                                    <div class="text-center mb-3 mb-lg-0">
                                        <h3 class="font-weight-light text-danger">2.5%</h3>
                                        <p class="text-muted mb-0">Refund</p>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="font-weight-light text-primary">+23.65%</h3>
                                        <p class="text-muted mb-0">Online</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>Latest projects</strong></h4>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Start date</th>
                                                <th>End date</th>
                                                <th>Status</th>
                                                <th>Assigned to</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h6 class="font-weight-normal">Be Single Minded</h6>
                                                    <p class="mb-0 text-muted">Advertising Outdoors</p>
                                                </td>
                                                <td>
                                                    13 May 2018
                                                </td>
                                                <td>
                                                    19 Jun 2018
                                                </td>
                                                <td>
                                                    <label class="badge badge-success">Done</label>
                                                </td>
                                                <td>
                                                    Betty Howard
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="font-weight-normal">Buy Youtube Views</h6>
                                                    <p class="mb-0 text-muted">Promote With Postcards</p>
                                                </td>
                                                <td>
                                                    30 Oct 2018
                                                </td>
                                                <td>
                                                    17 Sep 2018
                                                </td>
                                                <td>
                                                    <label class="badge badge-primary">On hold</label>
                                                </td>
                                                <td>
                                                    Calvin Wood
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="font-weight-normal">The Importance Of Human Life</h6>
                                                    <p class="mb-0 text-muted">Illustration In Marketing Materials</p>
                                                </td>
                                                <td>
                                                    06 Dec 2018
                                                </td>
                                                <td>
                                                    31 Jul 2018
                                                </td>
                                                <td>
                                                    <label class="badge badge-warning">In progress</label>
                                                </td>
                                                <td>
                                                    Carl Dennis
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="font-weight-normal">Enlightenment Is Not Just One State</h6>
                                                    <p class="mb-0 text-muted">Promotional Advertising Specialty You Ve Waited Long Enough</p>
                                                </td>
                                                <td>
                                                    15 Jul 2018
                                                </td>
                                                <td>
                                                    19 Nov 2018
                                                </td>
                                                <td>
                                                    <label class="badge badge-danger">Cancelled</label>
                                                </td>
                                                <td>
                                                    Florence Holland
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="font-weight-normal">Feedback Management</h6>
                                                    <p class="mb-0 text-muted">Characteristics Of A Successful Advertisement</p>
                                                </td>
                                                <td>
                                                    04 Sep 2018
                                                </td>
                                                <td>
                                                    20 Jul 2018
                                                </td>
                                                <td>
                                                    <label class="badge badge-success">Done</label>
                                                </td>
                                                <td>
                                                    Abbie Hughes
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center mt-4">
                                        <nav>
                                            <ul class="pagination pagination-flat pagination-primary">
                                                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-left"></i></a></li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-right"></i></a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
@endsection