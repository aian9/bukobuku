@extends("layouts.admin_dashboard")

@php
    /** @var \App\Order[] $order */
    /** @var \App\DataTransfer[] $dataTransfer */
@endphp

@section('title','Dashboard Admin')

@section('css')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
    <main>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    List Kota
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
                            <div class="card-body p-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Provinsi</th>
                                            <th>Nama Kota</th>
                                            <th>Kode Kota</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                         @foreach($data as $key => $value) 
                                            <tr>
                                              <td>{{ $key+1 }}</td>
                                              <td>{{ $provinsi[$value->id_provinsi]['nama'] }}</td>
                                              <td>{{ $value->nama }}</td>
                                              <td>{{ $value->kode_kota }}</td>
                                              <td>
                                                <button class="btn btn-sm btn-warning" onclick="edit({{ $value->id }})"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger" onclick="hapus({{ $value->id }})"><i class="fa fa-remove"></i></button>
                                              </td>
                                            </tr>
                                            @endforeach

                                        <tr>
                                            <form action="{{ route('admin.listkota.act') }}" method="POST" enctype="multipart/form-data" id="formku">
                                            <td>
                                                @csrf
                                                <input type="hidden" name="idkota" id="idkota">
                                            </td>
                                            <td>
                                                <select class="form-control" name="idprovinsi" id="idprovinsi">
                                                    @foreach($provinsi as $key => $value)
                                                    <option value="{{ $value['id'] }}">{{ $value['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="namakota" id="namakota" required="required" placeholder="Masukan Nama"></td>
                                            <td><input type="number" class="form-control" name="kodekota" id="kodekota" required="required" placeholder="Masukan Kode"></td>
                                            <td>
                                                <center>
                                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i></button>
                                                </center>
                                            </td>
                                            </form>
                                        </tr>
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
        
    </main>
@endsection

@section('js')
   <script type="text/javascript">
        function edit(id) {
          $('#formku').attr('action', '{{ route('admin.listkota.update') }}');

          $.ajax({
            url : "{{ url('admin/kota/edit') }}/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {   
                $("#idkota").val(data.id);
                $("#namakota").val(data.nama);
                $("#idprovinsi").val(data.id_provinsi);
                $("#kodekota").val(data.kode_kota);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('error'+textStatus);
            }
          });
        }

        function hapus(id) {
          $.ajax({
            url : "{{ url('admin/kota/destroy') }}/" + id,
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
  </script>
@endsection