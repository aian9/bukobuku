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
                    <div class="col-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    Manage List Order
                                </h5>
                            </div>
                            @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('success')}}
                            </div>
                            @elseif (Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('error')}}
                                </div>
                            @endif
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table  table-responsive">
                                    <thead>
                                        <tr>
                                            {{-- <th>No</th> --}}
                                            <th>No.</th>
                                            <th>Invoice</th>
                                            <th>Siswa</th>
                                            <th>Guru</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Tangal Order</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($data as $key => $value)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>
                                                {{ $i }}
                                            </td>
                                            <td>
                                                {{ $value["kode_transaksi"] }}
                                            </td>
                                            <td>
                                                {{ $user[$value["id_murid"]]["nama_lengkap"] }}
                                            </td>
                                            <td>
                                                {{ $user[$value["id_guru"]]["nama_lengkap"] }}
                                            </td>
                                            <td>
                                                {{ $mapel[$value["id_matpel"]]["nama"] }}
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    {{ $value["created_at"] }}
                                                </p>
                                            </td>
                                            <td>
                                                {{ "Rp. ".$value["total"] }}
                                            </td>
                                            <td>
                                                @if($value["status"]==0)
                                                    {{ "Menunggu Persetujuan Guru" }}
                                                @elseif($value["status"]==1)
                                                    {{ "Guru Menyutujui" }}
                                                @elseif($value["status"]==2)
                                                    {{ "Menunggu Pembayaran" }}
                                                @elseif($value["status"]==3)
                                                    <label style="background-color:orange; color:white">{{ "Telah Dibayar" }}</label>
                                                @elseif($value["status"]==4)
                                                    <label style="background-color:#17a2b8; color:white">{{ "Order Di Approve" }}</label>
                                                @elseif($value->status==5)
                                                    <label style="background-color:green; color:white">{{ "Order Telah Selesai" }}</label>
                                                @else
                                                    <label style="background-color:red; color:white">{{ "Pesanan Dibatalkan" }}</label>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    @if ($value["status"]==3)
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-info mr-2" data-toggle="modal" data-target="#verifyModal" onclick="show({{ $value['id'] }})">
                                                            <i class="fas fa-eye" data-toggle="tooltip" data-placement="bottom" title="Preview Bukti Transfer"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#approvemodal" onclick="approve({{ $value['id'] }})">
                                                            <i class="fas fa-check" data-toggle="tooltip" data-placement="bottom" title="Setujui Order"></i>
                                                        </button>
                                                    @endif
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary mr-2">
                                                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Detail Order"></i>
                                                    </a>
                                                    @if($value["status"]==3)
                                                    <button type="button" class="btn btn-sm btn-danger mr-2" data-toggle="modal" data-target="#approvemodal" onclick="cancel({{ $value['id'] }})">
                                                        <i class="fas fa-remove" data-toggle="tooltip" data-placement="bottom" title="Cancel Order"></i>
                                                    </button>
                                                    @endif
                                                </div>
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
                        <h5 class="modal-title" id="verifyModalLabel">Detail Bukti Transfer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <label id="labelku">Kode Transaksi :</label><br>
                            <center>
                            <img src="https://www.pexels.com/photo/beautiful-beauty-blue-bright-414612/" width="70%" height="70%" style="border: 5px solid #DDD;" id="imgku">
                            </center>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
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
                                <a href="{{ url('admin/listorder/approve')."/".$value["id"] }}" class="btn btn-lg btn-success mr-2" id="btnoke">
                                    IYA
                                </a>
                                <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">TIDAK</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@section('js')
    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });

        function show(id){
            $.ajax({
                url : "{{ url('admin/listorder/show') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {   
                    $("#labelku").html("Kode Transaksi : "+data.kode);
                    $("#imgku").attr("src", data.foto);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    //alert('error'+textStatus);
                }
          });
        }
    //
        function approve(id){
            $("#confirmmodal").text("Approve Order ?");
            $("#btnoke").attr("href", "{{ url('admin/listorder/approve') }}/"+id); 
        }

        function cancel(id){
            $("#confirmmodal").text("Cancel Order ?");
            $("#btnoke").attr("href", "{{ url('admin/listorder/cancel') }}/"+id); 
        }
    </script>
@endsection