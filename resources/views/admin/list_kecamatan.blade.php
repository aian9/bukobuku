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
                            <div class="card-body p-0">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>kota</th>
                                            <th>Nama Kecamatan</th>
                                            <th>Kode Kecamatan</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                         @foreach($data as $key => $value) 
                                            <tr>
                                              <td>{{ $key+1 }}</td>
                                              <td>{{ $kota[$value['id_kota']]['nama'] }}</td>
                                              <td>{{ $value['nama'] }}</td>
                                              <td>{{ $value['kode_kecamatan'] }}</td>
                                              <td>
                                                <button class="btn btn-md btn-warning" onclick="edit({{ $value['id'] }})">
                                                <i class="fa fa-pencil-square-o"></i></button>
                                                <button class="btn btn-md btn-danger" onclick="hapus({{ $value['id'] }})">
                                                <i class="fa fa-remove"></i>
                                                </button>
                                              </td>
                                            </tr>
                                            @endforeach

                                        <tr>
                                            <form action="{{ route('admin.listkecamatan.act') }}" method="POST" enctype="multipart/form-data" id="formku">
                                            <td>
                                                @csrf
                                                <input type="hidden" name="idkecamatan" id="idkecamatan">
                                            </td>
                                            <td>
                                                <select class="form-control" name="idkota" id="idkota">
                                                    @foreach($kota as $key => $value)
                                                    <option value="{{ $value['kode_kota'] }}">{{ $value['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="namakecamatan" id="namakecamatan" required="required" placeholder="Masukan Nama"></td>
                                            <td><input type="number" class="form-control" name="kodekecataman" id="kodekecataman" required="required" placeholder="Masukan Kode"></td>
                                            <td>
                                                <center>
                                                    <button type="submit" class="btn btn-md btn-success">
                                                        <i class="fa fa-save"></i>
                                                    </button>
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
          $('#formku').attr('action', '{{ route('admin.listkecamatan.update') }}');
          $.ajax({
            url : "{{ url('admin/kecamatan/edit') }}/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {   
                $("#idkecamatan").val(data.id);
                $("#namakecamatan").val(data.nama);
                $("#idkota").val(data.id_kota);
                $("#kodekecataman").val(data.kode_kecamatan);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('error'+textStatus);
            }
          });
        }

        function hapus(id) {
          $.ajax({
            url : "{{ url('admin/kecamatan/destroy') }}/" + id,
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