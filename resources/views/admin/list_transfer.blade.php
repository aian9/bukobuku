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
                    <div class="col-12 col-lg-11">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    Verifikasi Transfer
                                </h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Bank</th>
                                            <th>Bank</th>
                                            <th>Nomor Rekening</th>
                                            <th>Nama Rekening</th>
                                            <th>Nomimal Transfer</th>
                                            <th>Keterangan</th>
                                            <th>Status Pembayaran</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $bank[$value["id_bank"]]["kode_bank"] }}</td>
                                            <td>{{ $bank[$value["id_bank"]]["nama_bank"] }}</td>
                                            <td>{{ $value["no_rekening"] }}</td>
                                            <td>{{ $value["nama"] }}</td>
                                            <td>{{ $value["nominal"] }}</td>
                                            <td>{{ $value["keterangan"] }}</td>
                                            <td>
                                            @if($value["status"]==0)
                                                <label style="background-color:orange; color:white">{{ "Telah Dibayar" }}</label>
                                           @elseif($value["status"]==1)
                                                <label style="background-color:#17a2b8; color:white">{{ "Approve Admin" }}</label>
                                            @elseif($value["status"]==2)
                                                <label style="background-color:green; color:white">{{ "Order Selesai" }}</label>
                                            @else
                                             <label style="background-color:red; color:white">{{ "Order Dibatalkan" }}</label>
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

        <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalLabel">Verifikasi Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Bank</label>
                        <select name="" id="" class="form-control select2">
                            <option>BCA</option>
                            <option>Mandiri</option>
                            <option>BRI</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Bukti Transfer</label>
                                <input type="file" class="dropify" data-height="110" data-max-file-size="3M" data-default-file="dist/assets/img/upload.png"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="form-group">
                                <label for="">No. Rekening</label>
                                <input type="number" class="form-control" name="" id="" placeholder="No. Rekening">
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Transfer</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">IDR</span>
                                    </div>
                                    <input type="number" class="form-control" name="" id="" placeholder="Jumlah Transfer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="" id="" class="form-control select2">
                            <option>Paid</option>
                            <option>Unpaid</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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