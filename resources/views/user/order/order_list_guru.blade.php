@extends('layouts.user_dashboard')

@section('title',"Daftar Pesanan")

@php
    /** @var \App\Order[] $order */
    /** @var \App\OrderDate $order_date */
@endphp

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <style>
        .jadwal-row{margin-left: 0 !important;margin-right: 0!important;}
        .invalid-feedback{display: block!important;}
        .star-rating .ic{
            color: #d7ba00;
        }
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
        @foreach($order as $item)
            <div class="col-8 offset-2 mt-3">
                <div class="card">
                    <div class="card-header">
                        Invoice {{$item->no_invoice()}}
                    </div>
                    <div class="card-body">
                        <label for="" class="font-weight-bold">Nama Murid</label>
                        <p>{{$item->murid->nama_lengkap}}</p>
                        <label for="" class="font-weight-bold">Mata Pelajaran</label>
                        <p>{{$item->matpel->nama." ".$item->matpel->jenjang->nama." ".$item->matpel->jenjang->tingkat}}</p>
                        <label for="" class="font-weight-bold">Tempat Mengajar</label>
                        <p>{{$item->order_dates[0]->alamat_jalan}}, {{$item->order_dates[0]->kecamatan->nama}}, {{$item->order_dates[0]->kecamatan->kota->nama}}, {{$item->order_dates[0]->kecamatan->kota->provinsi->nama}}</p>
                        <label for="" class="font-weight-bold">Status Pesanan</label>
                        <p>{{$item->statusText()}}</p>
                        <label for="" class="font-weight-bold">Tanggal Mengajar</label>
                        <ul>
                        @foreach($item->order_dates as $order_date)
                                <li>{{\Carbon\Carbon::parse($order_date->datetime)->formatLocalized('%d %B %Y %H:%M')}}</li>
                        @endforeach
                        </ul>
                        @if($item->status == \App\Order::STATUS_DONE && !empty($item->review))
                        <label for="" class="font-weight-bold">Review Murid</label>
                        <p class="star-rating">
                            @for($i=0;$i<$item->review->rating;$i++)
                                <span class="ic fa fa-star"></span>
                            @endfor
                            @for($i=0;$i<5-$item->review->rating;$i++)
                                <span class="ic far fa-star"></span>
                            @endfor
                        </p>
                        <p>{{$item->review->review}}</p>
                        @endif
                    </div>
                    @if($item->status == \App\Order::STATUS_PAYMENT_VERIFIED)
                    <div class="card-footer">
                        <form method="post" action="{{route('user.dashboard.konfirmasi_guru.act')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <button class="btn btn-success" type="submit" name="action" value="1">Terima</button>
                            <button class="btn btn-danger" type="submit" name="action" value="0">Tolak</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('js')
@endsection