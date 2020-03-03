@extends("layouts.admin_dashboard")

@php
    /** @var \App\Order[] $order */
    /** @var \App\DataTransfer[] $dataTransfer */
@endphp

@section('title','Dashboard Admin')

@section('css')
@endsection

@section('content')
 <main>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    Verifikasi Profile Guru
                                </h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="input-group mb-3 col-md-4" style="margin-top: 15px"> 
                                    <div class="input-group mb-3">
                                      <input type="text" id="myInput" class="form-control" placeholder="Cari User" aria-label="Cari User" aria-describedby="basic-addon2" onkeyup="myFunction()">
                                      <div class="input-group-append">
                                        <span class="btn btn-primary" id="basic-addon2"><i class="fa fa-search"></i></span>
                                      </div>
                                    </div>
                                </div>
                                <table class="table table-bordered table-responsive" id="tableku">
                                    <thead>
                                        <tr>
                                            <th width="20%">Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No Telp</th>
                                            <th>Pendidikan Terakhir</th>
                                            <th width="15%">Alamat Asal</th>
                                            <th width="15%">Alamat Domisili</th>
                                            <th width="15%">Deskripsi</th>
                                            <th width="8%">Profile</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <a href="{{ url('admin/listguru/mapel/'.$value->id.".jpg") }}">
                                                        @if(asset('img/uploads/profile')."/".$value->id.".jpg")
                                                        <img src="{{ asset('img/uploads/profile')."/".$value->id.".jpg" }}" class="teacher-image rounded-circle mr-3" width="60px" height="60px" style="border: 5px solid #DDD; margin-top:10pt">
                                                        @else
                                                        <img src="{{ asset('img/')."/"."profile_laki.jpg" }}" class="teacher-image rounded-circle mr-3" width="60px" height="60px" style="border: 5px solid #DDD; margin-top:10pt">
                                                       @endif 
                                                    </a>
                                                    <span>
                                                        <p class="mb-0 font-weight-bold">{{ $value->nama_lengkap}}</p>
                                                        <small class="text-muted">
                                                        
                                                        </small>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    {{ $value->jenis_kelamin }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    {{ $value->no_hp }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    {{ $value->tingkat }}
                                                </p>
                                            </td>
                                            <td>
                                                @if ($value->alamat_jalan && $value->alamat_kota)
                                                    <p class="mb-0">
                                                        {{ $value->alamat_jalan."  -" }} <br>
                                                        {{ $kota[$value->alamat_kota]["nama"] }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($value->alamat_jalan_domisili && $value->alamat_kota_domisili)
                                                    <p class="mb-0">
                                                        {{ $value->alamat_jalan_domisili."  -" }}<br>
                                                        {{ $kota[$value->alamat_kota_domisili]["nama"] }}
                                                    </p>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($value->deskripsi)
                                                    <p class="mb-0">
                                                        {{ $value->deskripsi }}
                                                    </p>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($value->link)
                                                    <a href="{{ $value->link }}" target="_blank" class="btn btn-xs btn-success">
                                                        <i class="fa fa-eye" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail Profile"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <center>
                                                    @if ($value->verified_profile==0)
                                                        <button class="btn btn-sm btn-default mr-2" onclick="addtoVerivy({{ $value->id }})" style="width: 75px;" data-toggle="modal" data-target="#verifyModal">
                                                            Approval
                                                        </button>
                                                    @else
                                                        <a href="{{ url('admin/listguru/mapel')."/".$value->id }}" class="btn btn-md btn-info mr-2" style="width: 40px;">
                                                            <i class="far fa-calendar-check"></i>
                                                        </a>
                                                    @endif
                                                    </center>
                                            </td>
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

        <center>
        <div class="container">
            <ul class="pagination">
               {{ $data->links() }}
            </ul>
        </div>
        </center>
        
        <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalLabel">Verifikasi Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.listguru.verifikasi') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <select name="status" id="status" class="form-control select2">
                        <option value="1">Verify</option>
                        <option value="0">Don't Verify</option>
                    </select>
                    <input type="hidden" name="verif" id="verif">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')

<script type="text/javascript">
    function addtoVerivy(id) {
        $("#verif").val(id);
    }

    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("tableku");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }


</script>

@endsection