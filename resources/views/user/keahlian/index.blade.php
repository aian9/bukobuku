@extends('layouts.user_dashboard')

@section('title',"Keahlian")

@section('css')
    <style>
        select,input{display: block}
    </style>
@endsection

@section('content')
    <div class="offset-2 col-8 mt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$errors->first()}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="offset-2 col-8 mb-5">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">Keahlian</h3>
                <div class="float-right">
                    <a href="{{route('user.dashboard.keahlian.create')}}" class="btn btn-primary">Tambah Baru</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Tarif (perjam)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $x=1;
                    @endphp
                    @foreach($mpg as $item)
                        <tr>
                            <td>{{$x++}}</td>
                            <td>{{$item->matpel->nama." ".$item->matpel->jenjang->nama." ".$item->matpel->jenjang->tingkat}}</td>
                            <td>Rp {{$item->tarif}}</td>
                            <td>{{$item->status==\App\MataPelajaranGuru::STATUS_VERIFIED?"Disetujui":"Belum disetujui"}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection