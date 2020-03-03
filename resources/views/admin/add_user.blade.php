@extends("layouts.admin_dashboard")

@php
    /** @var \App\Order[] $order */
    /** @var \App\DataTransfer[] $dataTransfer */
@endphp

@section('title','Dashboard Admin')

@section('css')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
     <main>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <form action="{{ route('admin.listuser.act') }}" method="POST">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    Add New User
                                </h5>
                                <button class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <input type="file" class="dropify" data-height="220" data-max-file-size="3M" data-default-file="dist/assets/img/avatar.jpg"/>
                                    </div>
                                    <div class="col-12 col-lg-8">
                                        <div class="form-group">
                                            <label for="">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="" id="" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input type="text" class="form-control" name="" id="" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="font-weight-bold">Alamat Tinggal</h6>
                                        <div class="form-group row">
                                            <div class="col-12 col-lg-4">
                                                <label for="">Provinsi</label>
                                                <select class="form-control select2">
                                                    <option>Pilih</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <label for="">Kota/Kabupaten</label>
                                                <select class="form-control select2">
                                                    <option>Pilih</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <label for="">Kode Pos</label>
                                                <input type="number" class="form-control" name="" id="" placeholder="Kode Pos">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    
@endsection