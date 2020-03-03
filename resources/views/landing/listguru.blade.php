@extends('layouts.user_dashboard')

@section('title',"Sapaguru - Education Technology Startup")

@section('css')
    <style>
        input{display: block}
    </style>
@endsection

@php
    /** @var \Illuminate\Support\MessageBag $errors */
@endphp
@section('content')
    <main>
        <section class="p-0">
            <div class="section-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="find-teacher">
                                        <div class="title text-center">
                                            <h2>
                                                <span>Cari</span> Guru
                                            </h2>
                                            @if (isset($error))
                                                <div class="alert alert-warning">
                                                    {{ $error }}
                                                </div>
                                            @endif
                                        </div>
                                        <form action="{{ route('user.dashboard.findguru') }}" method="POST" enctype="multipart/form-data">
                                            <div class="row justify-content-center">
                                                @csrf
                                                <div class="col-12 col-lg-3 text-center">
                                                    <div class="form-group">
                                                        <select class="form-control select2" name="bidang" id="bidang">
                                                            <option value="0">-- Pilih Bidang --</option>
                                                            @foreach($bidang as $item => $val)
                                                            <option value="{{ $val['id'] }}">{{ $val['nama_bidang'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-3 text-center">
                                                    <div class="form-group">
                                                        <select class="form-control select2" name="mapel" id="mapel">
                                                            <option value="0">-- Pilih Mata Pelajaran --</option>
                                                            @foreach($mapel as $item => $val)
                                                            <option value="{{ $val['id'] }}">{{ $val['nama'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-3 text-center">
                                                    <div class="form-group">
                                                        <input type="text"
                                                            class="cari form-control" name="kota" id="kota" placeholder=" -- Pilih Kota --">
                                                        <input type="hidden" name="kota_id" id="kota_id" >
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2 text-center">
                                                    <div class="input-group">
                                                        <select class="form-control select2" name="jam" id="jam">
                                                            <option value="0">-- Pilih Jam --</option>
                                                            @foreach($jam as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-1 pl-lg-0 text-center">
                                                    <button type="submit" class="btn btn-block btn-primary text-white" style="min-height: 38px;">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="row">
                                @foreach($data as $item => $val)
                                <div class="col-lg-3 col-6 card-teacher-left">
                                    <div class="card">
                                        <center>
                                        <a href="{{ url('listguru/detail')."/".$val->id }}">
                                            <img src="{{ asset('img/uploads/profile')."/".$val->id.".jpg" }}" class="teacher-image rounded-circle mr-3" width="120px" height="120px" style="border: 5px solid #DDD; margin-top:10pt">
                                        </a>
                                        </center>
                                        <div class="card-body" style="height: 160px;">
                                            <a href="{{ url('listguru/detail')."/".$val->id }}">
                                                <h6 class="mb-1">{{ $val->nama_lengkap }}</h6>
                                            </a>
                                            <small class="text-muted">
                                                <i class="fas fa-mars-stroke"></i>
                                                {{ $val->jenis_kelamin }}
                                            </small>
                                            {{-- <br>
                                            <small class="text-muted">
                                                <i class="fas fa-phone"></i>
                                                {{ $val->no_hp }}
                                            </small> --}}
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-map-marker-alt"></i>
                                                @if ($val->alamat_kota_domisili)
                                                    {{ $kota[$val->alamat_kota_domisili]["nama"] }}
                                                @endif
                                            </small>
                                            <br>
                                            @if (isset($rating[$val->id]))
                                                <div class="rating">
                                                    @for ( $i=0;  $i<$rating[$val->id]["rating"]; $i++)
                                                        <i class="fas fa-star active"></i>
                                                    @endfor
                                                    <small>({{ $rating[$val->id]["rating"] }})</small>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="row" >
                                                <div class="col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                                    <a href="{{ url('listguru/detail')."/".$val->id }}" class="btn btn-xs btn-info">
                                                        <i class="fa fa-user" aria-hidden="true"></i> Detail
                                                    </a>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <button class="btn btn-xs btn-warning" style="color:white" data-toggle="modal" data-target="#verifyModal" onclick="addorder({{ $val->id }})">
                                                        <i class="fa fa-shopping-cart"></i> Order
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- Modal Order --}}
        <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        @if (Auth::user())
                        <h5 class="modal-title" id="verifyModalLabel">Order Guru</h5>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @if (Auth::user())
                        <div class="modal-body">
                            <form action="{{ route('admin.listorder.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <center>
                            {{-- <div class="container-fluid">
                                <img src="{{ url('http://bio-rev.com/wp-content/uploads/2017/12/njehyqzewkvnhyelehxp.png') }}"
                                srcset="{{ url('http://bio-rev.com/wp-content/uploads/2017/12/njehyqzewkvnhyelehxp.png') }}" alt="logo" style="width:40%; height:40%">
                            </div> --}}
                            </center> <br>
                            <div class="row container">
                                <div class="form-group col-xs-10 col-sm-6 col-md-6 col-lg-6">
                                <label for="">Pilih Guru</label>
                                <select name="id_guru" id="id_guru" class="form-control select2">
                                    @foreach ($guru as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('id_guru') }}</span>
                            </div>
                            <div class="form-group col-xs-10 col-sm-6 col-md-6 col-lg-6">
                                <label for="">Pilih Mata Pelajaran</label>
                                <select name="id_matpel" id="id_matpel" class="form-control select2">
                                        <option>- Pilih Mapel -</option>
                                    @foreach ($mapel as $key => $value)
                                        <option value="{{ $value['id'] }}">{{ $value['nama'] }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="harga" name="harga"/>
                                <span class="text-danger">{{ $errors->first('id_matpel') }}</span>
                            </div>

                            <div class="form-group col-xs-10 col-sm-12 col-md-12 col-lg-12">
                                <label for="">Jumlah Pertemuan</label>
                                <select name="durasi" id="durasi" class="form-control">
                                    @for ($i=1;  $i<11; $i++)
                                    <option value="{{ $i }}"> {{ $i." Kali Pertemuan" }} </option>
                                    @endfor
                                </select>
                                <span class="text-danger">{{ $errors->first('durasi') }}</span>
                            </div>

                            <div class="clearfix"></div>
                            <div class="form-group col-xs-10 col-sm-12 col-md-12 col-lg-12">
                                <label for="">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                                <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                            </div>

                           <div class="clearfix"></div>
                            <div class="form-group col-xs-10 col-sm-12 col-md-12 col-lg-12">
                                <label for="">Total Order</label>
                                <input class="form-control" id="total1" name="total1" type="text" readonly="true">
                                <input id="total" name="total" type="hidden">
                            </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning" style="color:white">Order</button>
                        </div>
                        </form>
                    @else
                        <div class="modal-body">
                            <center>
                            <h4>Silahkan Login Terlebih Dulu</h4>
                            <img src="{{asset('dist/assets/img/logo/logo-square.png') }}" srcset="{{ asset('dist/assets/img/logo/logo-square.png 2x') }}" alt="logo">
                            <br><br>
                            <a class="btn btn-warning hidden-sm hidden-xs" href="{{route('login')}}" style="color:white">
                                <b>Masuk</b>
                            </a>
                            </center>
                        </div>
                    @endif
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
        $('#kota').autocomplete({
            source:'{!!URL::route('dashboard.loadKota')!!}',
              minlength:1,
              autoFocus:true,
              select:function(e,ui)
              {
                  $('#kota').val(ui.item.value);
                  $('#kota_id').val(ui.item.kode_kota);
              }
        });

        $("#id_matpel").change(function () {
            var input = {
                        "_token": "{{ csrf_token() }}",
                        "id_guru": $("#id_guru").val(),
                        "id_matpel": $("#id_matpel").val()};

            $.ajax({
                url : "{{ url('listguru/gettotal') }}",
                type: "POST",
                data: input,
                dataType: "JSON",
                success: function(data)
                {
                    var day = 24*60*60*1000;
                    var harga = data.tarif;
                    var durasi = $("#durasi").val();

                    $("#harga").val(harga);

                    $("#total1").val(convertToRupiah(harga*durasi));
                    $("#total").val(harga*durasi);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    //alert('error'+textStatus);
                }
            });

        });

        function chainmapel(id){
            $.ajax({
                url : "{{ url('listguru/selectmapel/') }}/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#id_matpel').empty();
                    $('#id_matpel')
                            .append($('<option>', { value : "0" })
                            .text("-- Pilih Mata Pelajaran --"));
                    $.each(data, function(key, value) {
                        $('#id_matpel')
                            .append($('<option>', { value : value.id })
                            .text(value.nama));
                    });
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    //alert('error'+textStatus);
                }
            });
        }

        function chainbidang(id){
            $.ajax({
                url : "{{ url('listguru/selectbidangmapel/') }}/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#mapel').empty();
                    $('#mapel')
                            .append($('<option>', { value : "0" })
                            .text("-- Pilih Mata Pelajaran --"));

                    $.each(data, function(key, value) {
                        $('#mapel')
                            .append($('<option>', { value : value.id })
                            .text(value.nama));
                    });
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    //alert('error'+textStatus);
                }
            });
        }
        
        $("#id_guru").change(function () {
            chainmapel($("#id_guru").val());
        });

        $("#bidang").change(function () {
            chainbidang($("#bidang").val());
        });

        $("#durasi").change(function () {
            var harga = $("#harga").val();
            var durasi = $("#durasi").val();

            $("#total1").val(convertToRupiah(harga*durasi));
            $("#total").val(harga*durasi);
        });

        function convertToRupiah(angka)
        {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }


        function convertToAngka(rupiah)
        {
            return parseInt(rupiah.replace(/[^0-9]/g, ''), 10);
        }

        function addorder(id){
            $("#id_guru").val(id);
            chainmapel(id);
        }

    </script>
@endsection
