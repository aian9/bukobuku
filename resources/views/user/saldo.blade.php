@extends('layouts.user_dashboard')

@section('title',"Saldo")

@php
    /** @var \App\Transaksi $item */
    /** @var \Carbon\Carbon $startDate */
    /** @var \Carbon\Carbon $endDate */
@endphp

@section('css')

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
    <div class="col-12 row">
        <div class="offset-2 col-8 card mb-4 bg-primary text-white">
            <form action="{{route('user.dashboard.saldo')}}" method="post" class="row card-body">
                <div class="form-group col-12">
                    Saldo kamu saat ini Rp {{number_format($saldo,2,',','.')}}
                </div>
                @csrf
                <div class="form-group col-4 text-center">
                    <input type="date" class="form-control" name="awal" value="{{$startDate->format('Y-m-d')}}">
                </div>
                <div class="col-1 text-center">
                    -
                </div>
                <div class="form-group col-4 text-center">
                    <input type="date" class="form-control" name="akhir" value="{{$endDate->format('Y-m-d')}}">
                </div>
                <div class="form-group col-3 text-center">
                    <button class="btn btn-secondary" type="submit" style="width: 70%;">Cari</button>
                </div>
            </form>
        </div>
        @foreach($transaksi as $item)
            <div class="offset-2 col-8 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="">{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i')}}</label>
                            <p>{{empty($item->keterangan)?"-":$item->keterangan}}</p>
                        </div>
                        <div class="col-3 text-center">
                            <label for="">Nominal</label>
                            <p>{{$item->tipe() == \App\Transaksi::TIPE_IN ? "+":"-"}} Rp {{number_format($item->nominal,2,',','.')}}</p>
                        </div>
                        <div class="col-3 text-center">
                            <label for="">Saldo</label>
                            <p>Rp {{number_format($saldoBefore,2,',','.')}}</p>
                        </div>
                    </div>
                @php
                    if ($item->tipe() == \App\Transaksi::TIPE_IN)
                        $saldoBefore = $saldoBefore - $item->nominal;
                    else
                        $saldoBefore = $saldoBefore + $item->nominal;
                @endphp
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('js')
@endsection