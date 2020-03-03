@extends('layouts.user_dashboard')

@section('title',"Invoice #".$no_invoice)

@php
    /** @var \App\MataPelajaran[] $matpel */
    /** @var \App\User|\App\UserData $guru */
    /** @var \App\Order $order */
    /** @var \App\RekeningSapaGuru $rekening */
@endphp

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <style>
        .jadwal-row{margin-left: 0 !important;margin-right: 0!important;}
        .invalid-feedback{display: block!important;}
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
    <div class="offset-lg-3 col-lg-6 offset-sm-2 col-sm-8 mt-3 mb-5">
        <div class="card">
            <div class="card-header">
                Invoice {{$order->no_invoice()}}
            </div>
            <div class="card-body">
                @if($order->status==\App\Order::STATUS_WAITING_PAYMENT)
                    <div class="mb-4">
                        <p>Silakan melakukan transfer sejumlah <b>Rp {{number_format($order->nominal_discounted(),2,',','.')}}</b> ke nomor rekening</p>
                        <ul>
                        @foreach($rekening as $item)
                            <li>
                                <b>{{$item->bank}}</b> atas nama <b>{{$item->nama}}</b> <b>{{$item->no_rekening}}</b>
                            </li>
                        @endforeach
                        </ul>
                        <p class="text-center"><a href="{{route('user.dashboard.konfirmasi_pembayaran',$order->no_invoice())}}" class="btn btn-primary">Konfirmasi Pembayaran</a></p>
                        <div class="line-break"></div>
                    </div>
                @endif
                <div>
                    <style>
                        .detail-list{display: flex;}
                        .detail-list .sub-head,.detail-list .sub-body{width: 50%;display: inline-block}
                        .detail-list .sub-head{color: rgba(0,0,0,.54);}
                        .detail-list .sub-body{}
                        .line-break{border: .5px solid rgba(0,0,0,.7);height: 2px;opacity: .12;margin: 16px 0;}
                    </style>
                    <h5>Detail Pembayaran</h5>
                    <div class="detail-list">
                        <div class="sub-head">Guru</div>
                        <div class="sub-body"><a href="{{route('user.show_guru',$guru->username)}}">{{$guru->nama_lengkap}}</a></div>
                    </div>
                    <div class="detail-list">
                        <div class="sub-head">Mata Pelajaran</div>
                        <div class="sub-body">{{$order->matpel->nama}} {{$order->matpel->jenjang->nama}} {{$order->matpel->jenjang->tingkat}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection