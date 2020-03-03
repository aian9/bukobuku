@extends("layouts.admin_dashboard")

@section('title','Pengaduan Detail')

@section('css')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.css')}}">
    <style type="text/css">
        .btn-circle {
          width: 80px;
          height: 40px;
          text-align: center;
          margin: 5px;
          font-size: 12px;
          line-height: 1.42;
          border-radius: 20px;
          margin-bottom: 10pt;
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    Detail Pengaduan
                                </h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="row">
                                            {{-- Chat Untuk Admin --}}
                                            <div class="col-12 col-lg-12">
                                                <h6 style="color:red; margin: 10pt" id="txtjadwal">Keluhan : </h6>
                                                <span class="chat-img1 pull-left">
                                                @if(file_exists(asset('img/uploads/profile')."/".$data->id.".jpg"))
                                                <img src="{{ asset('img/uploads/profile')."/".$data->id.".jpg" }}" class="teacher-image rounded-circle mr-3" width="70px" height="70px" style="border: 5px solid #DDD; margin:5pt">
                                                @else
                                                <img src="{{ asset('img/')."/"."profile_laki.jpg" }}" class="teacher-image rounded-circle mr-3" width="70px" height="70px" style="border: 5px solid #DDD; margin-left: 5px;">
                                                @endif
                                                 </span>
                                                <div class="row"  style="border: 1px solid #c0d6e4; min-height: 50px; margin-left: 10px; margin-right: 10px; margin-top: 10pt; border-radius: 10px; background-color: #f8f9fa; ">
                                                    <div class="col-12 col-lg-12">
                                                        {{ $pengaduan["pengaduan"]." ?" }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            {{-- Chat Untuk Admin --}}

                                            <div class="col-12 col-lg-12">
                                                <h6 style="color:green; margin-left: 10pt" id="txtjadwal">Diskusi Jawaban : </h6>

                                                @foreach($detail as $key => $val)
                                                @if($val["is_admin"]==1)
                                                    <span class="chat-img1 pull-right">
                                                    @if(file_exists(asset('img/uploads/profile')."/".$userdata->id.".jpg"))
                                                    <img src="{{ asset('img/uploads/profile')."/".$userdata->id.".jpg" }}" class="teacher-image rounded-circle mr-3" width="70px" height="70px" style="border: 5px solid #DDD; margin-left: 5px;">
                                                    @else
                                                    <img src="{{ asset('img/')."/"."admin.png" }}" class="teacher-image rounded-circle mr-3" width="70px" height="70px" style="border: 5px solid #DDD; margin-left: 5px;">
                                                    @endif
                                                     </span>
                                                    <div class="row"  style="border: 1px solid #c0d6e4; min-height: 50px; margin-left: 10px; margin-right: 10px; margin-top: 10pt; border-radius: 10px; background-color: #e1fbe7; ">
                                                        <div class="col-12 col-lg-12">
                                                            {{ $val["jawaban"] }}
                                                        </div>
                                                    </div><br>
                                                @endif

                                                @if($val["is_admin"]!=1)
                                                    <span class="chat-img1 pull-left">
                                                    @if(file_exists(asset('img/uploads/profile')."/".$data->id.".jpg"))
                                                    <img src="{{ asset('img/uploads/profile')."/".$data->id.".jpg" }}" class="teacher-image rounded-circle mr-3" width="70px" height="70px" style="border: 5px solid #DDD; margin-left: 5px;">
                                                    @else
                                                    <img src="{{ asset('img/')."/"."profile_laki.jpg" }}" class="teacher-image rounded-circle mr-3" width="70px" height="70px" style="border: 5px solid #DDD; margin-left: 5px;">
                                                    @endif
                                                     </span>
                                                    <div class="row"  style="border: 1px solid #c0d6e4; min-height: 50px; margin-left: 10px; margin-right: 10px; margin-top: 10pt; border-radius: 10px; background-color: #f8f9fa; ">
                                                        <div class="col-12 col-lg-12">
                                                            {{ $val["jawaban"] }}
                                                        </div>
                                                    </div><br>
                                                @endif

                                                @endforeach

                                                <div class="col-12 col-lg-12">
                                                    <form action="{{ route('admin.pengaduan.detail.act') }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" name="pengaduan" id="pengaduan" value="{{ $pengaduan->id }}">
                                                            <span class="text-danger">{{ $errors->first('pengaduan') }}</span>
                                                            <textarea class="form-control" placeholder="Masukan Jawaban Anda Disini" style="margin-right: 10px; min-height: 80px;" name="jawaban" id="jawaban"></textarea>
                                                            <span class="text-danger">{{ $errors->first('jawaban') }}</span>
                                                            <button class="btn btn-xs btn-info btn-circle pull-right">
                                                                <i class="fa fa-send" ata-toggle="tooltip" data-placement="left" title="Kirim Tanggapan"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <br>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <center>
            <div class="container">
                <ul class="pagination">
                  {{--  {{ $data->links() }} --}}
                </ul>
            </div>
        </center>
        
    </main>
@endsection

@section('js')
   
@endsection