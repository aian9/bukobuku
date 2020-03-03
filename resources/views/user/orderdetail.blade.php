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
            width:30%;
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
                                                    Jadwal Belajar
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
                                        <h6 style="color:red" id="txtjadwal"></h6>
                                        <table class="table table-responsive">
                                        <?php $i = 0; ?>
                                        @foreach ($detail as $key => $value)
                                            <tr>
                                                <table class="table table-responsive">
                                                    <tr bgcolor="#f8f9fa" style="border: 1px solid #c0d6e4;">
                                                        <td width="30%">
                                                            <label class="code">Tanggal Belajar :</label><br>
                                                            {{ $value->date }}
                                                        </td>
                                                        <td width="30%">
                                                            <label class="code">Keterangan :</label><br>
                                                            {{ $value->keterangan }}
                                                        </td>
                                                        <td width="35%">
                                                            <label class="code">Status Jadwal :</label><br>
                                                            @if ($value->status==0)
                                                                <?php $i++; ?>
                                                                {{ "Belum Dibuat" }}
                                                            @elseif($value->status==1)
                                                                {{ "Dibuat Murid" }}
                                                            @elseif($value->status==2)
                                                                {{ "Diubah Guru" }}
                                                            @elseif($value->status==3)
                                                                {{ "Disetujui Guru" }}
                                                            @else
                                                                {{ "Belajar Selesai" }}
                                                            @endif
                                                        </td>
                                                        <td width="40%">
                                                            @if ($value["status"]==3)
                                                                <a href="{{ url("admin/listorder/accepted/")."/".$value["id"] }}" class="btn btn-xs btn-success" style="color:white;" data-toggle="tooltip" data-placement="bottom" title="Setujui Jadwal">
                                                                    <i class="fa fa-hourglass-end" data-toggle="tooltip" data-placement="bottom" title="Jadwal Selesai"></i> 
                                                                </a>
                                                            @elseif ($value["status"]==4)
                                                                
                                                            @else
                                                                <center>
                                                                @if($user->tipe_akun==2)
                                                                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#approvemodal" onclick="approve({{ $value['id'] }})">
                                                                        <i class="fas fa-check" data-toggle="tooltip" data-placement="bottom" title="Setujui Jadwal"></i>
                                                                    </button>
                                                                @endif
                                                                    <button type="button" class="btn btn-xs btn-warning" style="color:white;" onclick="edit({{ $value['id'] }})" data-toggle="modal" data-target="#modaljadwal" data-placement="right" title="Atur Jadwal">
                                                                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Atur Jadwal"></i>
                                                                    </button>
                                                                </center>
                                                            @endif
                                                            @if($user->tipe_akun==1)
                                                            <a href="{{ url('user/order/pengaduan'."/".$value['id']) }}" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="bottom" title="Pengaduan">
                                                                <i class="fas fa-clipboard" data-toggle="tooltip" data-placement="bottom" title="Pengaduan"></i>
                                                            </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </tr>
                                        @endforeach

                                        @if (count($detail)<1)
                                            <tr>
                                                <center>
                                                <table class="table table-responsive">
                                                    <tr bgcolor="#f8f9fa" style="border: 1px solid #c0d6e4;">
                                                        <td width="25%" colspan="3">
                                                            <b> <label class="code">Belum ada jadwal yang dibuat</label> </b><br>
                                                        </td>
                                                    </tr>
                                                </table>
                                                </center>
                                            </tr>
                                        @endif
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
                            <input type="hidden" id="id_order" name="id_order" value="{{ $order->id }}" />
                            <input type="hidden" id="iddetail" name="iddetail"/>
                            @if($user->tipe_akun==1)
                            <input class="form-control" type="date" id="date" name="date" placeholder="Tanggal Pelaksanaan">
                            @else
                            <input class="form-control" type="date" id="date" name="date" placeholder="Tanggal Pelaksanaan" readonly="true"/>
                            @endif
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
        $("#txtjadwal").html({{ $i }}+" X Jadwal Pertemuan Belum Dibuat");
        function edit(id) {
          $('#formku').attr('action', '{{ route('admin.listorder.update') }}');
          $("#iddetail").val(id);   

          $.ajax({
            url : "{{ url('admin/listorder/edit/') }}/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {   
                $("#id").val(data.id);
                $("#keterangan").val(data.keterangan);
                $("#date").val(data.date);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('error'+textStatus);
            }
          });
        }

        function hapus(id) {
          $.ajax({
            url : "{{ url('admin/listorder/delete') }}/" + id,
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

        function approve(id){
            $("#confirmmodal").text("Approve Jadwal ?");
            $("#btnoke").attr("href", "{{ url('admin/listorder/accepted') }}/"+id); 
        }
  </script>
@endsection