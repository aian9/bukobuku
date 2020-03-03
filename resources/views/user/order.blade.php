@extends('layouts.user_dashboard')

@section('title',"Order")

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

        /* Rating Star Widgets Style */
        .rating-stars ul {
        list-style-type:none;
        padding:0;
        
        -moz-user-select:none;
        -webkit-user-select:none;
        }
        .rating-stars ul > li.star {
        display:inline-block;
        
        }

        /* Idle State of the stars */
        .rating-stars ul > li.star > i.fa {
        font-size:2.5em; /* Change the size of the stars */
        color:#ccc; /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul > li.star.hover > i.fa {
        color:#FFCC36;
        }

        /* Selected state of the stars */
        .rating-stars ul > li.star.selected > i.fa {
        color:#FF912C;
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
                                                    Data Order
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
                                        @foreach ($order as $key => $value)
                                            <br>
                                            <div class="row"  style="border: 1px solid #c0d6e4; background-color: #f8f9fa">
                                                <div class="col-12 col-lg-3">
                                                    <div class="form-group">
                                                        <label class="code">Kode Transaksi :</label><br>
                                                        {{ $value->kode_transaksi }}
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-3">
                                                    <div class="form-group">
                                                        <label class="code">Tanggal Pesan :</label><br>
                                                        {{ $value->created_at }}
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-3">
                                                    <div class="form-group">
                                                        <label class="code">Status Pesanan :</label><br>
                                                            @if($value->status==0)
                                                                {{ "Menunggu Persetujuan Guru" }}
                                                            @elseif($value->status==1)
                                                                {{ "Guru Menyutujui" }}
                                                            @elseif($value->status==2)
                                                                {{ "Menunggu Pembayaran" }}
                                                            @elseif($value->status==3)
                                                                <label style="background-color:orange; color:white">{{ "Telah Dibayar" }}</label>
                                                            @elseif($value->status==4)
                                                                <label style="background-color:#17a2b8; color:white">{{ "Order Di Approve" }}</label>
                                                            @elseif($value->status==5)
                                                                <label style="background-color:green; color:white">{{ "Order Telah Selesai" }}</label>
                                                            @else
                                                                <label style="background-color:red; color:white">{{ "Pesanan Dibatalkan" }}</label>
                                                            @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 col-lg-3">
                                                    <div class="form-group" style="padding-top:20px">
                                                        @if ($user->tipe_akun==1)
                                                                @if ($value->status==4)
                                                                    <a href="{{ url('user/order/detail')."/".$value->id }}" class="btn btn-xs btn-info" style="color:white">
                                                                        <label style="font-size:8pt; margin-top:4pt">Atur Jadwal</label>
                                                                    </a>
                                                                @elseif($value->status==1)
                                                                    <a href="{{ url('user/listorder/pembayaran')."/".$value->kode_transaksi }}" class="btn btn-xs btn-primary">
                                                                        <label style="font-size:8pt; margin-top:4pt">Bayar Order</label>
                                                                    </a>
                                                                @elseif($value->status==2)
                                                                    <a href="{{ url('user/listorder/pembayaran')."/".$value->kode_transaksi }}" class="btn btn-xs btn-success">
                                                                        <label style="font-size:8pt; margin-top:4pt">Konfirmasi</label>
                                                                    </a>
                                                                @elseif($value->status==0 or $value->status==3)
                                                                    {{ "-" }}
                                                                @elseif($value->status==5)
                                                                    @if (!isset($rating[$value->id]))
                                                                        <button class="btn btn-xs btn-success" style="color:white" onclick="rating({{ $value->id }})" data-toggle="modal" data-target="#verifyModal">
                                                                        <i class="fa fa-star"></i>
                                                                        Nilai</button>
                                                                    @else
                                                                        <div class="rating">
                                                                            @for ( $i=0;  $i<$rating[$value->id]["rating"]; $i++)
                                                                                <i class="fas fa-star active"></i>
                                                                            @endfor
                                                                            <small>({{ $rating[$value->id]["rating"] }})</small>
                                                                        </div>
                                                                    @endif
                                                                @else 
                                                                    <a href="{{ url('user/listorder/pembayaran')."/".$value->kode_transaksi }}" class="btn btn-xs btn-primary">
                                                                        <label style="font-size:8pt; margin-top:4pt">Order Lagi</label>
                                                                    </a>
                                                                @endif
                                                            @elseif ($user->tipe_akun==2)
                                                                @if($value->status==4)
                                                                    <a href="{{ url('user/order/detail')."/".$value->id }}" class="btn btn-xs btn-info" style="color:white">
                                                                        <label style="font-size:8pt; margin-top:4pt">Jadwal Murid</label>
                                                                    </a>
                                                                @elseif($value->status==0)
                                                                     <button type="button" class="btn btn-xs btn-success mr-2" data-toggle="modal" data-target="#approvemodal" onclick="approve({{ $value->id }})">
                                                                        <label style="font-size:8pt; margin-top:4pt">Terima Order</label>
                                                                    </button>
                                                                @else
                                                                    @if (isset($rating[$value->id]))
                                                                        <div class="rating">
                                                                            @for ( $i=0;  $i<$rating[$value->id]["rating"]; $i++)
                                                                                <i class="fas fa-star active"></i>
                                                                            @endfor
                                                                            <small>({{ $rating[$value->id]["rating"] }})</small>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row"  style="border: 1px solid #c0d6e4; background-color: #fff">
                                                <div class="col-12 col-lg-3">
                                                    <div class="form-group">
                                                        <center>
                                                        @if ($user->tipe_akun==1)
                                                            <label class="code">Guru :</label><br>
                                                            <a href="{{ url('listguru/detail')."/".$value->id_guru }}">
                                                            @if(asset('img/uploads/profile')."/".$value->id_guru.".jpg")
                                                            <img src="{{ asset('img/uploads/profile')."/".$value->id_guru.".jpg" }}" class="teacher-image rounded-circle mr-3" width="120px" height="120px" style="border: 5px solid #DDD;">
                                                            @else
                                                            <img src="{{ asset('img/')."/"."profile_laki.jpg" }}" class="teacher-image rounded-circle mr-3" width="120px" height="120px" style="border: 5px solid #DDD; margin-top:10pt">
                                                            @endif
                                                                <br>
                                                                <u>{{ $listuser[$value->id_guru]["nama_lengkap"] }}</u>
                                                            </a>
                                                        @elseif ($user->tipe_akun==2)
                                                            <label class="code text-center">Murid :</label><br>
                                                            @if(asset('img/uploads/profile')."/".$value->id_murid.".jpg")
                                                            <img src="{{ asset('img/uploads/profile')."/".$value->id_murid.".jpg" }}" class="teacher-image rounded-circle mr-3" width="90px" height="90px" style="border: 5px solid #DDD;">
                                                            @else
                                                            <img src="{{ asset('img/')."/"."student_laki.ico" }}" class="teacher-image rounded-circle mr-3" width="120px" height="120px" style="border: 5px solid #DDD; margin-top:10pt">
                                                            @endif
                                                            <br>
                                                            <a href="#">
                                                                <u>{{ $listuser[$value->id_murid]["nama_lengkap"] }}</u>
                                                            </a>
                                                        @endif
                                                        </center>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-3">
                                                    <div class="form-group">
                                                        <label class="code">Mata Pelajaran :</label><br>
                                                        {{ $value->nama }}
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-3">
                                                    <div class="form-group">
                                                        <label class="code">Keterangan :</label><br>
                                                        {{ $value->keterangan }}
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 col-lg-3">
                                                    <div class="form-group">
                                                        @if ($user->tipe_akun==1)
                                                            <label class="code">Total Tagihan :</label><br>
                                                            {{ "Rp. ".$value->total }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <center>
                            <div class="container">
                                <ul class="pagination">
                                   {{ $order->links() }}
                                </ul>
                            </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        
        <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form action="{{ route('admin.listguru.rating') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <center>
                    <label>Luangkan Waktu Anda Sebentar Untuk Memberi 
                    Penilaian Terhadap Guru Selama Proses Pembelajaran <br>
                    ^_^</label>
                    </center>
                    <input type="hidden" name="rating" id="rating">
                    <div class='rating-stars text-center'>
                        <ul id='stars'>
                            <li class='star' title='Poor' data-value='1'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Fair' data-value='2'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Good' data-value='3'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Excellent' data-value='4'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='WOW!!!' data-value='5'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                        </ul>
                        <input type="hidden" name="id_order" id="id_order">
                    </div>
                    
                    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Beri Ulasan Sedikit Tentang Pembelaran"></textarea>
                
                    <div class='success-box' style="margin-top:5pt">
                        <div class='clearfix'>
                            <center> <b><label id="textrating" style="color:orange"> </label></b> </center>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-xs btn-primary" style="width:80px; height:30px"><b>Nilai</b></button>
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal" style="width:80px; height:30px"><b>Batal</b></button>
                </div>
                </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="approvemodal" tabindex="-1" role="dialog" aria-labelledby="approvemodal" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmmodal"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <div class="container-fluid">
                            <center>
                                <a href="" class="btn btn-xs btn-success mr-2" id="btnoke">
                                    IYA
                                </a>
                                <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">TIDAK</button>
                            </center>
                        </div>
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
        function edit(id) {
          $('#formku').attr('action', '{{ route('user.dashboard.jadwal.update') }}');

          $.ajax({
            url : "{{ url('user/jadwal/edit') }}/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {   
                $("#idwaktu").val(data.id);
                $("#hari").val(data.day);
                $("#jam").val(data.time);
                $("#jam_akhir").val(data.end_time);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('error'+textStatus);
            }
          });
        }

        function hapus(id) {
          $.ajax({
            url : "{{ url('user/jadwal/destroy') }}/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                window.location = "<?php echo URL::current(); ?>";
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('error'+textStatus);
            }
        });
        }

        function edit1(id) {
          $('#formku1').attr('action', '{{ route('user.dashboard.mapel.update') }}');

          $.ajax({
            url : "{{ url('user/mapelguru/edit') }}/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {   
                $("#idmatpel").val(data.id);
                $("#matpel").val(data.id_matpel);
                $("#tarif").val(data.tarif);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('error'+textStatus);
            }
          });
        }

        function rating(id){
            $("#id_order").val(id);
        }

        function hapus1(id) {
          $.ajax({
            url : "{{ url('user/mapelguru/destroy') }}/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                window.location = "<?php echo URL::current(); ?>";
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('error'+textStatus);
            }
        });
        }

        $(document).ready(function(){

            $('#stars li').on('mouseover', function(){
                var onStar = parseInt($(this).data('value'), 10); 

                $(this).parent().children('li.star').each(function(e){
                if (e < onStar) {
                    $(this).addClass('hover');
                }
                else {
                    $(this).removeClass('hover');
                }
                });
                
            }).on('mouseout', function(){
                $(this).parent().children('li.star').each(function(e){
                $(this).removeClass('hover');
                });
            });
            
            $('#stars li').on('click', function(){
                var onStar = parseInt($(this).data('value'), 10);
                var stars = $(this).parent().children('li.star');
                
                for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
                }
                
                for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
                }

                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                $("#rating").val(ratingValue);
                var msg = "";
                if (ratingValue > 1) {
                    msg = "Terimakasih ! Anda Memberi " + ratingValue + " Bintang.";
                }
                else {
                    msg = "Kami Akan Memperbaiki Pelayanan. Anda Memberi " + ratingValue + " Bintang.";
                }
                responseMessage(msg);
                
            });
        });


        function responseMessage(msg) {
            $("#textrating").html(msg);
        }

        function approve(id){
            $("#confirmmodal").text("Approve Order ?");
            $("#btnoke").attr("href", "{{ url('admin/listorder/setuju') }}/"+id); 
        }
  </script>
@endsection