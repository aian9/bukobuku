@extends('layouts.user_dashboard')

@section('title',"Tambah Keahlian Baru")

@php
    /** @var \App\MataPelajaran[] $matpel */
@endphp

@section('css')
    <style>
        select,input{display: block}
    </style>
@endsection

@section('content')
        <div class="offset-lg-4 col-lg-4 offset-sm-2 col-sm-8 mt-5">
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
        <div class="offset-lg-4 col-lg-4 offset-sm-2 col-sm-8 mt-3 mb-5">
            <form method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        Tambah Keahlian Baru
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="matpel">Mata Pelajaran</label>
                            <select id="matpel" class="form-control" name="matpel">
                                <option selected disabled>-</option>
                                @foreach($matpel as $itemMatpel)
                                <option value="{{$itemMatpel->id}}">{{$itemMatpel->nama." ".$itemMatpel->jenjang->nama." ".$itemMatpel->jenjang->tingkat}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tarif">Tarif (perjam)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input id="tarif" class="form-control" type="number" name="tarif">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('user.dashboard.keahlian.index')}}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
@endsection

@section('js')

@endsection