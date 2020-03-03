@extends('layouts.user_dashboard')

@section('title',"Dashboard")

@section('css')
@endsection

@section('content')
    @php
        /** @var \App\UserData|\App\UserStatus $userdata */
    @endphp

    @if(!$userdata->email_activated)
        <div>Email Belum Diverifikasi</div>
    @endif
    {{-- <li class="nav-item">
        <a class="btn btn-header hidden-sm hidden-xs" href="{{route('admin.transaksi.verifikasi')}}">
            Masuk
        </a>
    </li> --}}

@endsection

@section('js')
@endsection