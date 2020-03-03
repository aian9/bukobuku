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
                                    Data Tagihan
                                </h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Transaksi</th>
                                            <th>User</th>
                                            <th>Metode</th>
                                            <th>Bank</th>
                                            <th>Nomimal</th>
                                            <th>Tanggal Order</th>
                                            <th>Tanggal Berakhir</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $order[$value["id_order"]]["kode_transaksi"] }}</td>
                                            <td>{{ $user[$value["id_user"]]["nama_lengkap"] }}</td>
                                            <td>
                                            @if ($value["metode"]==1)
                                                {{ "Transfer Bank" }}
                                            @else
                                                {{ "Saldo" }}
                                            @endif
                                            </td>
                                            <td>{{ $bank[$value["id_bank"]]["nama_bank"] }}</td>
                                            <td>{{ $value["nominal"] }}</td>
                                            <td>{{ $value["create_date"] }}</td>
                                            <td>{{ $value["expired_date"] }}</td>
                                            <td>{{ $value["keterangan"] }}</td>
                                            <td>
                                            @if($value["status"]==0)
                                                <label style="background-color:orange; color:white">{{ "Tagihan dibuat" }}</label>
                                           @elseif($value["status"]==1)
                                                <label style="background-color:#17a2b8; color:white">{{ "Tagihan Dibayar" }}</label>
                                            @elseif($value["status"]==2)
                                                <label style="background-color:#17a2b8; color:white">{{ "Tagihan Di Approve" }}</label>
                                            @elseif($value["status"]==-1)
                                                <label style="background-color:red; color:white">{{ "Tagihan Di Batalkan" }}</label>
                                            @else
                                                <label style="background-color:green; color:white">{{ "Order Selesai" }}</label>
                                            @endif
                                            </td>
                                            <td>-</td>
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

    </main>
@endsection

@section('js')
    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            var t = $('.datatable').DataTable({
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0,
                } ],
                "order": [[ 1, 'asc' ]],
            });
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });

        $('.datatransfer').click(function () {
            $("#order-"+$(this).data('target')).modal('hide');
            $("#data-transfer-"+$(this).data('target')).modal('show');
            $("#data-transfer-"+$(this).data('target')+" form input#id").val($(this).data('content'));
        });

        $('form.delete').submit(function (e) {
            e.preventDefault();

            if (confirm('Apakah Anda yakin ingin membatalkan reservasi ini?'))
                this.submit();
        });
    </script>
@endsection