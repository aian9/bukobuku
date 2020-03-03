@extends('layouts.user_dashboard')

@section('title',"Konfirmasi Pembayaran Invoice #".$no_invoice)

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
        label.custom-file-label{overflow: hidden;}
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
        <div class="card">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    Konfirmasi Pembayaran <a href="{{route('user.dashboard.invoice',$order->no_invoice())}}">Invoice #{{$no_invoice}}</a>
                </div>
                <div class="card-body">
                    @if($konfirmasiPembayaran>0)
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Konfirmasi pembayaran untuk <b>Invoice #{{$no_invoice}}</b> sudah dilakukan sebelumnya!
                        Silakan menunggu atau mengirim ulang konfirmasi pembayaran apabila terjadi kesalahan!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" class="form-control" name="nama" placeholder="Atas Nama Pengirim" value="{{old('nama')}}">
                    </div>
                    <div class="form-group">
                        <label for="bank">Bank</label>
                        <input type="text" id="bank" class="form-control" name="bank" placeholder="Nama Bank" value="{{old('bank')}}">
                    </div>
                    <div class="form-group">
                        <label for="norek">No Rekening</label>
                        <input type="text" id="norek" class="form-control" name="norek" placeholder="No Rekening" value="{{old('norek')}}">
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="text" id="nominal" class="form-control" name="nominal" placeholder="Nominal" value="{{old('nominal')}}">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Opsional" value="{{old('keterangan')}}">
                    </div>
                    <div class="form-group">
                        <label>Bukti Transfer</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="bukti" name="bukti">
                            <label class="custom-file-label" for="bukti">Choose file...</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                    <a href="{{route('user.dashboard.invoice',$order->no_invoice())}}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init()
        })
    </script>
@endsection