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
                    <div class="col-10 col-lg-10">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <img src="{{ asset('img/uploads/profile')."/".$guru['id'].".jpg" }}" class="teacher-image rounded-circle mr-3" width="70px" height="70px" style="border: 5px solid #DDD;">
                                    Verifikasi Mata Pelajaran {{ $guru["nama_lengkap"] }}
                                </h5>
                            </div>
                        </div>
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
                            <div>
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th width="30%">Mata Pelajaran</th>
                                            <th width="30%">Tarif</th>
                                            <th width="40%"><center>Status</center></th>
                                            <th width="20%"><center>Action</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($data==null)
                                            <tr>
                                                <td colspan="4"><center><b>Data Kosong</b></center></td>
                                            </tr>
                                        @endif
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td>
                                                <p class="mb-0">
                                                    {{ $mapel[$value["id_matpel"]]["nama"] }}
                                                </p>
                                            </td>
                                            <td>{{ "Rp. ".$value    ["tarif"] }}</td>
                                            <td>
                                            <center>
                                            @if ($value["status"]==0)
                                                <a href="javascript:void(0);" class="btn btn-sm btn-warning mr-2" style="width: 100px;">
                                                        Not Approved
                                                </a>
                                            @else
                                                <a href="javascript:void(0);" class="btn btn-sm btn-success mr-2" style="width: 100px;">
                                                        Approved
                                                </a>
                                            @endif
                                            </center>
                                            </td>
                                            <td>
                                                <center>
                                                    @if ($value["verified_profile"]==0)
                                                        <button class="btn btn-sm btn-default mr-2" onclick="addtoVerivy({{ $value['id'] }})" style="width: 75px;" data-toggle="modal" data-target="#verifyModal">
                                                            Approval
                                                        </button>
                                                    @else
                                                        <a href="{{ url('admin/listguru/mapel')."/".$value["id"] }}" class="btn btn-md btn-info mr-2" style="width: 40px;">
                                                            <i class="far fa-calendar-check"></i>
                                                        </a>
                                                    @endif
                                                    </center>
                                            </td>
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
        
        <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalLabel">Verifikasi Mata Pelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.listguru.verifmapel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <select name="status" id="status" class="form-control select2">
                        <option value="1">Approve</option>
                        <option value="0">Don't Approve</option>
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
</script>

@endsection