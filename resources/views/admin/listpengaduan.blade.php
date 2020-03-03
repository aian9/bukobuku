@extends("layouts.admin_dashboard")

@section('title','Dashboard Admin')

@section('css')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.css')}}">
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
                                    List Pengaduan
                                </h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama User</th>
                                            <th>Pengaduan</th>
                                            <th>Waktu Pengaduan</th>
                                            <th width="15%"><center>Action</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pengaduan as $key => $val)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $val["nama_lengkap"] }}</td>
                                            <td>{{ $val["pengaduan"] }}</td>
                                            <td>{{ $val["created_at"] }}</td>
                                            <td>
                                                <center>
                                                <a href="{{ url("admin/pengaduan/detail/")."/".$val["id"] }}" class="btn btn-xs btn-info">
                                                    <i class="fa fa-send" data-toggle="tooltip" data-placement="left" title="Jawab Pengaduan"> </i>
                                                </a>
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
                  {{--  {{ $data->links() }} --}}
                </ul>
            </div>
        </center>
        
    </main>
@endsection

@section('js')
   
@endsection