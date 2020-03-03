@extends('layouts.user_dashboard')

@section('title',"Edit Profil")

@section('css')
    <style>
        select,input{display: block}
        .code {
            font-size:9pt;
            color:#aeadad;
            margin-bottom:-40px;
        }
        .photo-profile {
            width:50%;
        }
    </style>
@endsection

@section('content')
     <main style="margin-top:-55px">
        <div class="section-area">
            <div class="jumbotron jumbotron-fluid jumbotron-profile">
                <img src="" class="img-fluid" style="width: 100%;">
            </div>
        </div>
        <section class="teacher-profile">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card mb-4">
                            <div class="card-body pb-0">

                                @include('user.foto')

                                <div class="row">
                                    <div class="menu-profile">
                                        <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true">
                                                    Pembayaran
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('success')}}
                            </div>
                            @elseif (Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                {{Session::get('error')}}
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="tab-content border-0 bg-white" id="v-pills-tabContent myaccountContent">
                                    <div class="tab-pane  fade show active" id="order" role="tabpanel" aria-labelledby="order-tab">
                                        @if ($order->status==2 and isset($tagihan))
                                            <h6>Batas Pembayaran : <b>{{ $expired }}</b></h6>
                                            <div class="row"  style="border: 1px solid #c0d6e4; background-color: #f8f9fa; padding:6pt; margin-bottom:10pt">
                                                <div class="col-12 col-lg-12" style="border: 1px solid #c0d6e4; background-color: #fff;">
                                                    <div class="form-group"><br>
                                                        <center >
                                                            <label style=" font-size: 14pt">Nomor tagihan</label>
                                                            <h6 style="margin-top: -8pt;"><b>Rp. @if(isset($tagihan)) {{ $tagihan["nominal"] }} @endif</b></h6>
                                                            <br>

                                                            <label style="color:orange; font-size: 14pt">Nomor tagihan</label>
                                                            <h6 style="margin-top: -8pt;"><b><u>{{ $order->kode_transaksi }}</u></b></h6>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6>Petunjuk Pembayaran : </h6>
                                            <div class="row"  style="border: 1px solid #c0d6e4; background-color: #f8f9fa; padding:10pt; margin-bottom:10pt">
                                                <div class="col-12 col-lg-6" style="border: 1px solid #c0d6e4; background-color: #fff;">
                                                    <div class="form-group">
                                                        <label class="code">1. </label><br>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6" style="border: 1px solid #c0d6e4; background-color: #fff;">
                                                    <div class="form-group">
                                                        <label class="code">2. </label><br>
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-6" style="border: 1px solid #c0d6e4; background-color: #fff;">
                                                    <div class="form-group">
                                                        <label class="code">3. </label><br>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6" style="border: 1px solid #c0d6e4; background-color: #fff;">
                                                    <div class="form-group">
                                                        <label class="code">4. </label><br>
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                        @endif
                                        <h6>Detail Order : </h6>
                                        <div class="row"  style="border: 1px solid #c0d6e4; background-color: #f8f9fa">
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="code">Tanggal Order</label><br>
                                                    {{ $order->created_at }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="code">Durasi Belajar</label><br>
                                                    {{ $order->durasi." X Pertemuan" }}
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="code">Status Order :</label><br>
                                                    @if($order->status==0)
                                                        {{ "Menunggu Persetujuan Guru" }}
                                                    @elseif($order->status==1)
                                                        {{ "Guru Menyutujui" }}
                                                    @elseif($order->status==2)
                                                        {{ "Menunggu Pembayaran" }}
                                                    @elseif($order->status==3)
                                                        <label style="background-color:orange; color:white">{{ "Telah Dibayar" }}</label>
                                                    @elseif($order->status==4)
                                                        <label style="background-color:#17a2b8; color:white">{{ "Order Di Approve" }}</label>
                                                    @elseif($order->status==5)
                                                        <label style="background-color:green; color:white">{{ "Order Telah Selesai" }}</label>
                                                    @else
                                                        <label style="background-color:red; color:white">{{ "Pesanan Dibatalkan" }}</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" style="border: 1px solid #c0d6e4; margin-top:2px; background-color: #fff; margin-bottom:10px">
                                            <div class="col-12 col-lg-4">
                                                    <center>
                                                    <label class="code">Guru :</label><br><br>
                                                    @if(asset('img/uploads/profile')."/".$order->id_guru.".jpg")
                                                    <img src="{{ asset('img/uploads/profile')."/".$order->id_guru.".jpg" }}" class="teacher-image rounded-circle mr-3" width="120px" height="120px" style="border: 5px solid #DDD; margin-top:10pt">
                                                    @else
                                                    <img src="{{ asset('img/')."/"."profile_laki.jpg" }}" class="teacher-image rounded-circle mr-3" width="120px" height="120px" style="border: 5px solid #DDD; margin-top:10pt">
                                                   @endif 

                                                    <a href="{{ url('listguru/detail')."/".$order->id_guru }}"><br>
                                                        <u>{{ $listuser[$order->id_guru]["nama_lengkap"] }}</u><br>
                                                    </a>
                                                    </center>
                                            </div>
                                            
                                             <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="code">Mata Pelajaran</label><br>
                                                    {{ $mapel[$order->id_matpel]["nama"] }}
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="code">Keterangan</label><br>
                                                    {{ $order->keterangan }}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if ($order->status==1 or (!isset($tagihan) and $order->status==2) or $order->status==-1)
                                            <h6>Detail Pembayaran : </h6>
                                                <form action="{{ route('user.dashboard.bayar') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row" style="border: 1px solid #c0d6e4; margin-top:2px; background-color: #fff">
                                                    <div class="col-12 col-lg-4">
                                                        <div class="form-group">
                                                            <label class="code">Metode Pembayaran</label><br>
                                                            <select class="form-control" id="metode" name="metode">
                                                                <option value="1">Transfer Bank</option>
                                                            </select>
                                                        </div>  
                                                    </div>

                                                    <div class="col-12 col-lg-4">
                                                        <div class="form-group">
                                                            <label class="code">Daftar Bank</label><br>
                                                            <select class="form-control" id="bank" name="bank">
                                                                    <option>-- Pilih Bank --</option>
                                                                @foreach ($bank as $key => $value)
                                                                    <option value="{{ $value["id"] }}">{{ $value["kode_bank"]." - ".$value["nama_bank"] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>  
                                                    </div>

                                                    <div class="col-12 col-lg-4">
                                                        <div class="form-group">
                                                            <label class="code">Total Tagihan</label><br>
                                                            {{ "Rp. ".$order->total }}
                                                        </div>  
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="pull-right">
                                                    <input type="hidden" id="id_order" name="id_order" value="{{ $order->id }}">
                                                    <button type="submit" class="btn btn-xs btn-primary">
                                                        Bayar Tagihan
                                                    </button>
                                                </div>
                                            </form>
                                        @elseif($order->status==2 and isset($tagihan))
                                            <h6>Konfirmasi Pembayaran : </h6>
                                                <form action="{{ route('user.dashboard.konfirmasi') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row" style="border: 1px solid #c0d6e4; margin-top:2px; background-color: #fff">
                                                    <div class="col-12 col-lg-4">
                                                        <div class="form-group">
                                                            <label class="code">No Rekening Pengirim</label><br>
                                                            <input class="form-control" type="number" id="norek" name="norek" required="true" placeholder="Masukan Nomor Rekening" />
                                                            <span class="text-danger">{{ $errors->first('norek') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <div class="form-group">
                                                            <label class="code">Nama Rekening Pengirim</label><br>
                                                            <input class="form-control" type="text" id="nama" name="nama" required="true" placeholder="Masukan Nama Rekening" />
                                                            <span class="text-danger">{{ $errors->first('nama') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <div class="form-group">
                                                            <label class="code">Bukti Transfer</label><br>
                                                            <input class="form-control" type="file" id="bukti" name="bukti" required="true" placeholder="Pilih Bukti Transfer" />
                                                            <span class="text-danger">{{ $errors->first('bukti') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-lg-4">
                                                        <div class="form-group">
                                                            <label class="code">Keterangan</label><br>
                                                            <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Transfer"></textarea>
                                                            <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-lg-4">
                                                        <div class="form-group">
                                                            <label class="code">Nominal Transfer</label><br>
                                                            <input class="form-control" type="text" readonly="true" value="@if(isset($tagihan)) {{ $tagihan["nominal"] }} @endif"/>
                                                        </div>
                                                    </div>

                                                </div><br>

                                                <div class="pull-right">
                                                    <input type="hidden" id="id_tagihan" name="id_tagihan" value="@if(isset($tagihan)) {{ $tagihan["id"] }} @endif">
                                                    <span class="text-danger">{{ $errors->first('id_tagihan') }}</span>
                                                    <button type="submit" class="btn btn-xs btn-success">
                                                        Konfirmasi Transfer
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        
        <div class="modal fade" id="modalsuccess" tabindex="-1" role="dialog" aria-labelledby="modalsuccess" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verifyModalLabel">Konfirmasi Bukti Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <label >Kode Transaksi : {{ $order->kode_transaksi }} Telah Dibayarkan</label><br>
                            <center>
                                <img src="https://www.pexels.com/photo/beautiful-beauty-blue-bright-414612/" class="teacher-image rounded-circle mr-3" width="120px" height="120px" style="border: 5px solid #DDD;" id="imgku">
                            </center> <br>
                            <label>Silahkan Hubungi Admin Sapaguru Untuk Proses Mengatur Jadwal Pertemuan ^_^</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        @include('landing.footer')
    </main>
@endsection

@section('js')
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
    <script type="text/javascript">
        $('#modalsuccess').modal('show');
  </script>
@endsection