@extends('layouts.user_dashboard')

@section('title',"Edit Profil")

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
                                                @if(count($mdetail)<1 and count($detail)<1)
                                                    <a class="nav-link active" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true">
                                                        Waktu Mengajar
                                                    </a>
                                                @elseif(count($detail)>1)
                                                    <a class="nav-link active" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true">
                                                        Waktu Mengajar
                                                    </a>
                                                @else
                                                    <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true">
                                                        Waktu Mengajar
                                                    </a>
                                                @endif
                                            </li>
                                            
                                            <li class="nav-item">
                                                @if(count($mdetail)>1)
                                                <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">
                                                    Mata Pelajaran
                                                </a> 
                                                @else
                                                <a class="nav-link" id="about-tab active" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">
                                                    Mata Pelajaran
                                                </a> 
                                                @endif
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
                                    @if (\Route::current()->getName()=="user.dashboard.mapel.edit")
                                    <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                    @else 
                                    <div class="tab-pane" id="about" role="tabpanel" aria-labelledby="about-tab">
                                    @endif
                                        <div class="title-tab">
                                            <h3 class="mb-0">
                                               Mata Pelajaran
                                            </h3>

                                            @if (count($mdetail)<1)
                                            <button class="btn btn-xs btn-primary" onclick="showmapel()">
                                                <i class="fa fa-plus"></i>  Tambah
                                            </button>
                                            @endif
                                        </div>
                                            @if (count($mdetail)>1)
                                                <form action="{{ route('user.dashboard.mapel.update') }}" method="POST" enctype="multipart/form-data" id="formku1">
                                            @else
                                                <form action="{{ route('user.dashboard.mapel.act') }}" method="POST" enctype="multipart/form-data" id="formku1">
                                            @endif
                                            @csrf
                                            <table class="table table-bordered table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">No</th>
                                                        <th width="30%">Bidang</th>
                                                        <th width="38%">Mata Pelajaran</th>
                                                        <th width="40%"> Tarif Mengajar</th>
                                                        <th width="40%"> Status</th>
                                                        <th width="30%"> Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="rowmapel">
                                                        <td><input type="hidden" id="idmatpel" name="idmatpel" value="0"></td>
                                                        <td>
                                                            <select class="form-control" id="bidang" name="bidang">
                                                                <option>-- Pilih Bidang --</option>
                                                                @foreach($bidang as $key => $value)
                                                                <option value="{{ $key }}">{{ $value["nama_bidang"] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" id="matpel" name="matpel">
                                                                <option>-- Pilih Mata Pelajaran --</option>
                                                                @foreach($mapel as $key => $value)
                                                                <option value="{{ $value["id"] }}">{{ $value["nama"] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="number" id="tarif" name="tarif" placeholder="Masukan Tarif">
                                                        </td>
                                                        <td>

                                                        </td>
                                                        <td><button type="submit" class="btn btn-xs btn-success">
                                                        <i class="fa fa-save"></i>
                                                        </button></td>
                                                    </tr>
                                                    <?php $i = 0; ?>
                                                    @foreach($listmapel as $key => $value)
                                                    <?php $i++; ?>
                                                    <tr>
                                                        <td>
                                                        @if (count($mdetail)>1 and $mdetail["id"]==$value->id)
                                                            {{ $i }}
                                                            <input type="hidden" id="idmatpel1" name="idmatpel1" value="{{ $value->id }}">
                                                        @else
                                                            {{ $i }}
                                                        @endif
                                                        </td>
                                                        <td>
                                                            @if (count($mdetail)>1 and $mdetail["id"]==$value->id)
                                                                <select class="form-control" id="bidang1" name="bidang1">
                                                                    <option>-- Pilih Bidang --</option>
                                                                    @foreach($bidang as $key1 => $value1)
                                                                    <option value="{{ $key1 }}">{{ $value1["nama_bidang"]}}</option>
                                                                    @endforeach
                                                                </select>    
                                                                <span class="text-danger">{{ $errors->first('bidang1') }}</span>
                                                            @else
                                                                {{ $bidang[$value->id_bidang]["nama_bidang"] }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (count($mdetail)>1 and $mdetail["id"]==$value->id)
                                                            <select class="form-control" id="matpel1" name="matpel1">
                                                                <option>-- Pilih Mata Pelajaran --</option>
                                                                @foreach($mapel as $key1 => $value1)
                                                                <option value="{{ $value1["id"] }}">{{ $value1["nama"] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger">{{ $errors->first('matpel1') }}</span>
                                                            @else
                                                            {{ $mapel[$value->id_matpel]["nama"] }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (count($mdetail)>1 and $mdetail["id"]==$value->id)
                                                            <input class="form-control" type="number" id="tarif1" name="tarif1" placeholder="Masukan Tarif" value="{{ $value->tarif }}">
                                                            <span class="text-danger">{{ $errors->first('tarif1') }}</span>
                                                            @else
                                                            Rp. {{ $value->tarif }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (count($mdetail)>1 and $mdetail["id"]==$value->id)
                                                                -
                                                            @else
                                                                @if ($value["status"]==0)
                                                                    <a href="javascript:void(0);" class="btn btn-xs btn-warning mr-2">
                                                                            Unapproved
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0);" class="btn btn-xs btn-success mr-2">
                                                                            Approved
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td> 
                                                            <center>
                                                            @if (count($mdetail)>1 and $mdetail["id"]==$value->id)
                                                                <button type="submit" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="bottom" title="Simpan Jadwal">
                                                                    <i class="fa fa-save" data-toggle="tooltip" data-placement="bottom" title="Simpan Jadwal"></i>
                                                                </button>
                                                                <a href="{{ url('user/jadwal') }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="bottom" title="Batal Edit">
                                                                    <i class="fa fa-refresh"></i>
                                                                </a>
                                                            @else
                                                                <a href="{{ url('user/mapelguru/edit') }}/{{ $value->id }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Mapel">
                                                                <i class="fa fa-pencil"></i></a>
                                                                </button>
                                                                <button type="button" class="btn btn-xs btn-danger" onclick="hapus1({{ $value->id }})">
                                                                <i class="fa fa-remove"></i>
                                                                </button>
                                                            @endif
                                                            </center>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            </form>
                                        <div>
                                        </div>
                                    </div>
                                    {{-- {{ \Route::current()->getName() }} --}}
                                    @if (\Route::current()->getName()=="user.dashboard.jadwal" or \Route::current()->getName()=="user.dashboard.jadwal.edit" )
                                        <div class="tab-pane  fade show active" id="order" role="tabpanel" aria-labelledby="order-tab">
                                    @else
                                        <div class="tab-pane" id="order" role="tabpanel" aria-labelledby="order-tab">
                                    @endif
                                    
                                        <div class="title-tab">
                                            <h3 class="mb-0">
                                                Waktu Mengajar
                                            </h3>

                                            @if (count($detail)<1)
                                            <button class="btn btn-xs btn-primary" onclick="showwaktu()">
                                                <i class="fa fa-plus"></i>  Tambah
                                            </button>
                                            @endif
                                        </div>
                                        @if (count($detail)>1)
                                        <form action="{{ route('user.dashboard.jadwal.update') }}" method="POST" enctype="multipart/form-data" id="formku">
                                        @else
                                        <form action="{{ route('user.dashboard.jadwal.act') }}" method="POST" enctype="multipart/form-data" id="formku">
                                        @endif
                                        @csrf
                                        <table class="table table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th width="25%">No</th>
                                                    <th width="20%">Hari</th>
                                                    <th width="30%"> Jam Ajar</th>
                                                    <th width="30%"> Jam Selesai</th>
                                                    <th width="20%"> Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($detail)<1)
                                                <tr id="jadwalplus">
                                                    <td>
                                                        <input type="hidden" id="idwaktu" name="idwaktu" value="0">
                                                        Pilih Hari dan Jam
                                                    </td>
                                                    <td>
                                                        <select class="form-control" id="hari" name="hari">
                                                            <option>-- Pilih Hari --</option>
                                                            @foreach($hari as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control" id="jam" name="jam">
                                                            <option>-- Pilih Jam --</option>
                                                            @foreach($jam as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control" id="jam_akhir" name="jam_akhir">
                                                            <option>-- Pilih Jam --</option>
                                                            @foreach($jam as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><button type="submit" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="bottom" title="Simpan Jadwal">
                                                    <i class="fa fa-save" data-toggle="tooltip" data-placement="bottom" title="Simpan Jadwal"></i>
                                                    </button></td>
                                                </tr>
                                                @endif
                                                <?php $i = 0; ?>
                                                @foreach($jadwal as $key => $value)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>
                                                        @if (count($detail)>1 and $detail["id"]==$value->id)
                                                        <input type="hidden" id="idwaktu1" name="idwaktu1" value="{{ $value->id }}">
                                                        @else
                                                        {{ $i }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (count($detail)>1 and $detail["id"]==$value->id)
                                                            <select class="form-control" id="hari1" name="hari1" >
                                                                <option>-- Pilih Hari --</option>
                                                                @foreach($hari as $key1 => $value1)
                                                                <option value="{{ $key1 }}">{{ $value1 }}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                        {{ $hari[$value->day] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (count($detail)>1 and $detail["id"]==$value->id)
                                                        <select class="form-control" id="jam1" name="jam1">
                                                            <option>-- Pilih Jam --</option>
                                                            @foreach($jam as $key1 => $value1)
                                                            <option value="{{ $key1 }}">{{ $value1 }}</option>
                                                            @endforeach
                                                        </select>
                                                        @else
                                                        {{ $jam[$value->time] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (count($detail)>1 and $detail["id"]==$value->id)
                                                        <select class="form-control" id="jam_akhir1" name="jam_akhir1">
                                                            <option>-- Pilih Jam --</option>
                                                            @foreach($jam as $key1 => $value1)
                                                            <option value="{{ $key1 }}">{{ $value1 }}</option>
                                                            @endforeach
                                                        </select>
                                                        @else
                                                        {{ $jam[$value->end_time] }}
                                                        @endif
                                                    </td>
                                                    <td> 
                                                        <center>
                                                        @if (count($detail)>1 and $detail["id"]==$value->id)
                                                            <button type="submit" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="bottom" title="Simpan Jadwal">
                                                            <i class="fa fa-save" data-toggle="tooltip" data-placement="bottom" title="Simpan Jadwal"></i>
                                                            </button>
                                                            <a href="{{ url('user/jadwal') }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="bottom" title="Batal Edit">
                                                            <i class="fa fa-refresh"></i></a>
                                                        @else
                                                            <a href="{{ url('user/jadwal/edit') }}/{{ $value->id }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Jadwal">
                                                            <i class="fa fa-pencil"></i></a>
                                                            <button type="button" class="btn btn-xs btn-danger" onclick="hapus({{ $value->id }})" data-toggle="tooltip" data-placement="bottom" title="Hapus Jadwal">
                                                            <i class="fa fa-remove"></i>
                                                            </button>
                                                        @endif
                                                        </center>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        @include('landing.footer')
    </main>
@endsection

@section('js')
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
    <script type="text/javascript">
        $("#jadwalplus").hide();
        $("#rowmapel").hide();

        @if(count($detail)>1)
            $("#jam1").val("{{ $detail['time'] }}");
            $("#jam_akhir1").val("{{ $detail['end_time'] }}");
            $("#hari1").val("{{ $detail['day'] }}");
        @elseif(count($mdetail)>1)
            $("#tarif1").val("{{ $mdetail['tarif'] }}");
            $("#matpel1").val("{{ $mdetail['id_matpel'] }}");
            $("#bidang1").val("{{ $mdetail['id_bidang'] }}");
        @endif
        
        function showwaktu(){
            $("#jadwalplus").show();
        }
        
        function showmapel(){
            $("#rowmapel").show();
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
                $("#bidang").val(data.id_bidang);
                $("#tarif").val(data.tarif);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('error'+textStatus);
            }
          });
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

        function chainbidang(id){
            $.ajax({
                url : "{{ url('listguru/selectbidangmapel/') }}/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#matpel').empty();
                    $('#matpel')
                            .append($('<option>', { value : "0" })
                            .text("-- Pilih Mata Pelajaran --"));

                    $.each(data, function(key, value) {
                        $('#matpel')
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
        function chainbidang1(id){
            $.ajax({
                url : "{{ url('listguru/selectbidangmapel/') }}/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#matpel1').empty();
                    $('#matpel1')
                            .append($('<option>', { value : "0" })
                            .text("-- Pilih Mata Pelajaran --"));

                    $.each(data, function(key, value) {
                        $('#matpel1')
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
        $("#bidang").change(function () {
            chainbidang($("#bidang").val());
        });

        $("#bidang1").change(function () {
            chainbidang1($("#bidang1").val());
        });
  </script>
@endsection