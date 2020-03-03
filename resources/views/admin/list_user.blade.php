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
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    Manage User
                                </h5>
                                {{-- <a href="{{ route('admin.listuser.add') }}" class="btn btn-primary">
                                    Add New
                                </a> --}}
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th width="20%">User</th>
                                            <th width="20%">Alamat Domisili</th>
                                            <th width="20%">Tanggal Bergabung</th>
                                            <th width="20%">Tipe Akun</th>
                                            {{-- <th width="10%">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $key => $val)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <img src="{{ asset('img/uploads/profile')."/".$val->id.".jpg" }}" width="70px" height="70px" class="rounded-circle mr-2" style="border: 4px solid #ddd;">
                                                    <span>
                                                        <p class="mb-0 font-weight-bold">{{ $val->nama_lengkap }}</p>
                                                        
                                                        <small class="text-muted">
                                                            <i class="fas fa-genderless"></i>
                                                            {{ $val->jenis_kelamin }}
                                                        </small>
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="fas fa-phone"></i>
                                                            {{ $val->no_hp }}
                                                        </small>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($val->alamat_jalan_domisili && $val->alamat_kota_domisili)
                                                    <p class="mb-0">
                                                        {{ $val->alamat_jalan_domisili."  -" }}<br>
                                                        {{ $kota[$val->alamat_kota_domisili]["nama"] }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    {{ $val->created_at }}
                                                </p>
                                            </td>
                                            <td style="text-align:center;">
                                                @if($val->tipe_akun==10)
                                                    <span class="badge badge-danger">{{ $akun[$val->tipe_akun]["nama"] }}</span>
                                                @elseif($val->tipe_akun==2)
                                                    <span class="badge badge-warning">{{ $akun[$val->tipe_akun]["nama"] }}</span>
                                                @else
                                                    <span class="badge badge-primary">{{ $akun[$val->tipe_akun]["nama"] }}</span>
                                                @endif
                                            </td>
                                            {{-- <td>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-default mr-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <center>
                        <div class="container">
                            <ul class="pagination">
                            {{ $data->links() }}
                            </ul>
                        </div>
                        </center>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    
@endsection