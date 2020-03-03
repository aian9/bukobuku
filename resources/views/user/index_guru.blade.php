@extends('layouts.user_dashboard')

@section('title',"List Guru")

@php
    /** @var \App\User[]|\App\UserData[]|\App\UserStatus[] $data */
@endphp

@section('css')

@endsection

@section('content')
    <div class="row">
        @foreach($data as $guru)
            <div>
                {{$guru->nama_lengkap}}
            </div>
        @endforeach
    </div>
@endsection

@section('js')
@endsection