@extends('layouts.user_dashboard')

@section('title',"Layanan Pengaduan")

@section('css')
    <style>
        select,input{display: block}
        .code {
            font-size:9pt;
            color:#aeadad;
            margin-bottom:-40px;
        }
        .photo-profile {
            width:30%;
        }
        .btn-circle {
          width: 80px;
          height: 40px;
          text-align: center;
          margin: 5px;
          font-size: 12px;
          line-height: 1.42;
          border-radius: 20px;
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
                                                    Pengaduan
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
                                        <div class="title-tab">
                                            <h5 class="mb-0">
                                               Kode Order : {{ $order->kode_transaksi }}
                                            </h5><br>
                                        </div>
                                        <h6 style="color:red" id="txtjadwal">Keluhan : </h6>
                                        {{-- Untuk Pertanyaan --}}
                                        @if(isset($pengaduan) && count($pengaduan)>0)
                                        <div class="row">
                                            <div class="col-12 col-lg-12">
                                                <div class="row"  style="border: 1px solid #c0d6e4; min-height: 50px; margin-left: 10px; margin-right: 10px; border-radius: 10px; background-color: #f8f9fa; ">
                                                    <div class="col-12 col-lg-12">
                                                        {{ $pengaduan[0]["pengaduan"]." ?" }}
                                                    </div>
                                                </div> <br>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-12 col-lg-12">
                                            <form action="{{ route('user.dashboard.pengaduan.act') }}" method="post">
                                                <div class="form-group">
                                                    @csrf
                                                    <input type="hidden" name="id_jadwal"  name="id_jadwal" value="{{ $order->id }}">
                                                    <span class="text-danger">{{ $errors->first('id_jadwal') }}</span>

                                                    <textarea class="form-control" placeholder="Sampaikan Keluhan Anda Disini" style="margin-right: 10px; min-height: 80px;" id="pesan" name="pesan"></textarea>

                                                    <span class="text-danger">{{ $errors->first('pesan') }}</span>

                                                    <button class="btn btn-xs btn-info btn-circle pull-right">
                                                        <i class="fa fa-send" data-toggle="tooltip" data-placement="left" title="Kirim Tanggapan"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        @endif
                                        {{-- Untuk Jawaban --}}
                                        @if(isset($pengaduan) && count($pengaduan)>0)
                                        <h6 style="color:green" id="txtjadwal">Diskusi Jawaban : </h6>
                                        <div class="row">

                                            @foreach($detail as $key => $val)
                                            {{-- Chat Untuk Admin --}}
                                            @if($val["is_admin"]==1)
                                            <div class="col-12 col-lg-12">
                                                <span class="chat-img1 pull-left">
                                                <img src="{{ asset('img')."/"."admin.png" }}" class="teacher-image rounded-circle mr-3" width="70px" height="70px" style="border: 5px solid #DDD; margin:5pt">
                                                 </span>
                                                <div class="row"  style="border: 1px solid #c0d6e4; min-height: 50px; margin-left: 10px; margin-right: 10px; border-radius: 10px; background-color: #e1fbe7; ">
                                                    <div class="col-12 col-lg-12">
                                                        {{ $val["jawaban"] }}
                                                    </div>
                                                </div> <br>
                                            </div>
                                            @endif

                                            @if($val["is_admin"]!=1)
                                            {{-- Chat Untuk User --}}
                                            <div class="col-12 col-lg-12">
                                                <span class="chat-img1 pull-right">
                                                @if(asset('img/uploads/profile')."/".$userdata->id.".jpg")
                                                <img src="{{ asset('img/uploads/profile')."/".$userdata->id.".jpg" }}" class="teacher-image rounded-circle mr-3" width="70px" height="70px" style="border: 5px solid #DDD; margin:5pt">
                                                @else
                                                <img src="{{ asset('img/')."/"."profile_laki.jpg" }}" class="teacher-image rounded-circle mr-3" width="70px" height="70px" style="border: 5px solid #DDD; margin-left:5pt">
                                                @endif
                                                 </span>
                                                <div class="row"  style="border: 1px solid #c0d6e4; min-height: 50px; margin-left: 10px; margin-right: 10px; border-radius: 10px; background-color: #f8f9fa; ">
                                                    <div class="col-12 col-lg-12">
                                                        {{ $val["jawaban"] }}
                                                    </div>
                                                </div> <br>
                                            </div>
                                            @endif
                                            @endforeach
                                            {{-- Untuk Input Quentions or Answer --}}
                                            <div class="col-12 col-lg-12">
                                                <form action="{{ route('admin.pengaduan.detail.act') }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" name="pengaduan" id="pengaduan" value="{{ $pengaduan[0]["id"] }}">
                                                            <span class="text-danger">{{ $errors->first('pengaduan') }}</span>
                                                            <textarea class="form-control" placeholder="Masukan Jawaban Anda Disini" style="margin-right: 10px; min-height: 80px;" name="jawaban" id="jawaban"></textarea>
                                                            <span class="text-danger">{{ $errors->first('jawaban') }}</span>
                                                            <button class="btn btn-xs btn-info btn-circle pull-right">
                                                                <i class="fa fa-send" ata-toggle="tooltip" data-placement="left" title="Kirim Tanggapan"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <div class="modal fade" id="modaljadwal" tabindex="-1" role="dialog" aria-labelledby="modaljadwal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaljadwal">Atul Jadwal Belajar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.listorder.add') }}" method="POST" enctype="multipart/form-data" id="formku">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="">Tanggal Belajar</label>
                            <input type="hidden" id="id_order" name="id_order" value="{{ $order->id }}"/>
                            <input type="hidden" id="iddetail" name="iddetail"/>
                            <input class="form-control" type="date" id="date" name="date" placeholder="Tanggal Pelaksanaan"/>
                            <span class="text-danger">{{ $errors->first('date') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
                            <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning" style="color:white">Save</button>
                    </div>
                    </form>
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
        
  </script>
@endsection