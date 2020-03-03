@extends('layouts.user_dashboard')

@section('title',"Detail Profile Guru")

@section('css')
    <style>
        select,input{display: block}
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
                                                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                                                    Detail Profile
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true">
                                                    Waktu Mengajar
                                                </a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">
                                                    Mata Pelajaran
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
                            <div class="card-body">
                                <div class="tab-content border-0 bg-white" id="v-pills-tabContent myaccountContent">

                                    <div class="tab-pane  fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="title-tab">
                                            <h4 class="mb-0">
                                               Detail Profile
                                            </h4>
                                        </div>
                                        
                                        <div class="row"  style="border: 1px solid #c0d6e4; background-color:#fff; margin-top:6px">
                                            <div class="col-12 col-lg-6" style="padding-right:10pt"><br>
                                                <div class="form-group">
                                                <i class="fa fa-users" data-toggle="tooltip" data-placement="bottom" title="Deskripsi Kepribadian"> 
                                                </i><label class="code" style="margin-left:6px"><h5>Deskripsi Pribadi :</h5></label>
                                                <p style="margin-left:10px; margin-right:10px; min-height:150px; background:#fafafa" class="form-control" readonly="readonly">{{  $userdata->deskripsi }}</p>
                                                </div>
                                                <br>
                                            </div>

                                            <div class="col-12 col-lg-6"><br>
                                                <i class="fa fa-user" data-toggle="tooltip" data-placement="bottom" title="Video Profile"> 
                                                </i><label class="code" style="margin-left:6px"><h5>Video Profile :</h5></label><br>
                                                @if($userdata->link)
                                                <iframe src="{{  $userdata->link }}" style="margin-bottom:20px; width:100%; height:80% " class="form-control"></iframe> 
                                                @endif
                                                <br><br><br><br><br><br>
                                            </div>
                                        </div>
                                        
                                        <div class="row"  style="border: 1px solid #c0d6e4; background-color:#f2f5f6">
                                            <div class="col-12 col-lg-4"><br>
                                                <i class="fa fa-users" data-toggle="tooltip" data-placement="bottom" title="Nama Lengkap"> 
                                                </i><label class="code" style="margin-left:6px"><h5>Nama Lengkap :</h5></label><br>
                                                <label class="code" style="margin-left:18px">{{  $userdata->nama_lengkap }}</label>
                                            </div>

                                            <div class="col-12 col-lg-4"><br>
                                                <i class="fa fa-user" data-toggle="tooltip" data-placement="bottom" title="Nama Panggilan"> 
                                                </i><label class="code" style="margin-left:6px"><h5>Nama Panggilan :</h5></label><br>
                                                <label class="code" style="margin-left:18px">{{  $userdata->nama_panggilan }}</label>
                                            </div>

                                            <div class="col-12 col-lg-4"><br>
                                                <i class="fa fa-mars-stroke" data-toggle="tooltip" data-placement="bottom" title="Jenis Kelamin"> 
                                                </i><label class="code" style="margin-left:6px"><h5>Jenis Kelamin :</h5></label><br>
                                                <label class="code" style="margin-left:18px">{{  $userdata->jenis_kelamin }}</label>
                                            </div>
                                        </div>

                                        <div class="row"  style="border: 1px solid #c0d6e4; background-color: #fafafa; margin-top:7px">
                                            <div class="col-12 col-lg-4"><br>
                                                <i class="fa fa-graduation-cap" data-toggle="tooltip" data-placement="bottom" title="Pendidikan Terakhir"> 
                                                </i><label class="code" style="margin-left:6px"><h5>Pendidikan Terakhir :</h5></label><br>
                                                @if($userdata->jenjang_pendidikan) 
                                                <label class="code" style="margin-left:18px">{{  $jenjang[$userdata->jenjang_pendidikan]["nama"] }}</label>
                                                @endif
                                            </div>

                                            <div class="col-12 col-lg-4"><br>
                                                <i class="fa fa-home" data-toggle="tooltip" data-placement="bottom" title="Alamat Domisili"> 
                                                </i><label class="code" style="margin-left:6px"><h5>Alamat Asal :</h5></label><br>
                                                <label class="code" style="margin-left:18px">
                                                    @if($userdata->alamat_kecamatan) 
                                                    {{ $kecamatan[$userdata->alamat_kecamatan]["nama"] }} - {{ $kota[$kecamatan[$userdata->alamat_kecamatan]["id_kota"]]["nama"] }}
                                                    @endif
                                                </label><br>

                                                <label class="code" style="margin-left:18px">
                                                    @if($userdata->alamat_jalan) 
                                                    {{ $userdata->alamat_jalan }}
                                                    @endif
                                                </label><br>
                                            </div>

                                            <div class="col-12 col-lg-4"><br>
                                                <i class="fa fa-university" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Alamat Domisili"> 
                                                </i><label class="code" style="margin-left:6px"><h5>Alamat Domisili :</h5></label><br>
                                                <label class="code" style="margin-left:18px">
                                                    @if($userdata->alamat_kecamatan_domisili) 
                                                    {{ $kecamatan[$userdata->alamat_kecamatan_domisili]["nama"] }} - {{ $kota[$kecamatan[$userdata->alamat_kecamatan_domisili]["id_kota"]]["nama"] }}
                                                    @endif
                                                </label><br>
                                                
                                                <label class="code" style="margin-left:18px">
                                                    @if($userdata->alamat_jalan_domisili) 
                                                    {{ $userdata->alamat_jalan_domisili }}
                                                    @endif
                                                </label><br>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="about" role="tabpanel" aria-labelledby="about-tab">
                                        <div class="title-tab">
                                            <h3 class="mb-0">
                                               Mata Pelajaran
                                            </h3>
                                        </div>
                                            <form action="{{ route('user.dashboard.mapel.act') }}" method="POST" enctype="multipart/form-data" id="formku1">
                                            @csrf
                                            <table class="table table-bordered table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th width="20%">No</th>
                                                        <th width="30%">Bidang</th>
                                                        <th width="35%">Mata Pelajaran</th>
                                                        <th width="1000px"> Tarif</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; ?>
                                                    @foreach($listmapel as $key => $value)
                                                    <?php $i++; ?>
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $bidang[$value->id_bidang]["nama_bidang"] }}</td>
                                                        <td>{{ $mapel[$value->id_matpel]["nama"] }}</td>
                                                        <td>Rp. {{ $value->tarif }}</td>
                                                    </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                            </form>
                                        <div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="order" role="tabpanel" aria-labelledby="order-tab">
                                        <div class="title-tab">
                                            <h3 class="mb-0">
                                                Waktu Mengajar
                                            </h3>
                                        </div>
                                        <table class="table table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th width="50%">Hari Mengajar</th>
                                                    <th width="30%">Mulai</th>
                                                    <th width="100px"> Selesai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach($jadwal as $key => $value)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $hari[$value->day] }}</td>
                                                    <td>{{ $jam[$value->time] }}</td>
                                                    <td>{{ $jam[$value->end_time] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        
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
                                <span class="text-danger">{{ $errors->first('id_matpel') }}</span>
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
        $("#id_guru").change(function () {
            $.ajax({
                url : "{{ url('listguru/selectmapel') }}/" + $("#id_guru").val(),
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {   
                    $('#id_matpel').empty();
                    $('#id_matpel').append("<option>"+ "-- Pilih Mata Pelajaran --" +"</option>");
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
                   // alert('error'+textStatus);
                }
            });

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

        /**
        * Usage example:
        * alert(convertToRupiah(10000000)); -> Rp. 10.000.000
        */
        
        function convertToAngka(rupiah)
        {
            return parseInt(rupiah.replace(/[^0-9]/g, ''), 10);
        }
    </script>
@endsection