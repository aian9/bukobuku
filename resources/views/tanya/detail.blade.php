@extends("tanya.layout")

@php
    /** @var \App\Order[] $order */
    /** @var \App\DataTransfer[] $dataTransfer */
@endphp

@section('title','Tanya Guru')

@section('css')
<style type="text/css">
   .zoom {
      transition: transform .2s; /* Animation */
      max-height: 80%; 
      max-width: 80%;
      margin: 0 auto;
      position: relative;
      left: 10px;
    }

    .zoom1 {
      z-index: 5;
      transition: transform .2s; /* Animation */
      max-height: 100%; 
      max-width: 100%;
      padding-left: 10px;
      padding-right: 10px;
    }
</style>
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
                                    Detail Pertanyaan
                                </h5>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        {{-- Pertanyaan --}}
                                        <div class="row">
                                            <div class="col-lg-12 col-lg-12">
                                                <div class="col-lg-12 col-lg-4">
                                                    <div class="form-group">
                                                        <h5 class="text-primary" style="margin-top: 10px">Pertanyaan : </h5>
                                                        <h5 style="margin-top: -32px; margin-left: 125px">{{ $data->judul }}</h5>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-lg-4">
                                                    <img src="{{ asset('img/uploads/profile')."/".$data->id.".jpg" }}" class="teacher-image rounded-circle mr-3" width="80px" height="80px" style="border: 5px solid #DDD;">

                                                    @if(file_exists('storage/uploads/tanya/'.$data->foto))
                                                        <img src="{{ asset('/storage/uploads/tanya'."/".$data->foto) }}" id="myImg" class="zoom" data-toggle="modal" data-target="#myModal"/>
                                                    @else
                                                        <img src="{{ $data->foto }}" id="myImg" class="zoom" data-toggle="modal" data-target="#myModal"/>
                                                    @endif
                                                </div>

                                                <div class="row"  style="border: 1px solid #c0d6e4; min-height: 50px; margin-left: 10px; margin-right: 10px; margin-top: 10pt; border-radius: 10px; background-color: #eceef0; ">
                                                    <div class="col-12 col-lg-12">
                                                        {{ $data->pertanyaan." ?" }}
                                                    </div>
                                                </div><br>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach($detail as $key => $val)
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        {{-- Pertanyaan --}}
                                        <div class="row">
                                            <div class="col-12 col-lg-12">
                                                <div class="col-lg-12 col-lg-4">
                                                    <div class="form-group">
                                                        <h5 class="text-success" style="margin-top: 10px">Jawaban : </h5>
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-lg-6">
                                                    <div class="col-lg-12 col-lg-3">
                                                        @if($val["id_murid"]!=null)
                                                            <img src="{{ asset('img/uploads/profile')."/".$val["id_murid"].".jpg" }}" class="teacher-image rounded-circle mr-3" width="80px" height="80px" style="border: 5px solid #DDD; margin-bottom: 5px">
                                                            <h6>{{ $listuser[$val["id_murid"]]["nama_lengkap"] }}</h6>
                                                        @else
                                                            <img src="{{ asset('img/uploads/profile')."/".$val["id_guru"].".jpg" }}" class="teacher-image rounded-circle mr-3" width="80px" height="80px" style="border: 5px solid #DDD;">
                                                            <h6>{{ $listuser[$val["id_guru"]]["nama_lengkap"] }}</h6>
                                                        @endif
                                                    </div><br>
                                                    <div class="col-lg-12 col-lg-3">
                                                    @if(file_exists('storage/uploads/tanya/'.$data->foto))
                                                        <img src="{{ asset('/storage/uploads/tanya'."/".$data->foto) }}" id="myImg2" class="zoom" data-toggle="modal" data-target="#myModal" onclick="showfoto('{{ asset('/storage/uploads/tanya'."/".$data->foto) }}')" />
                                                    @else
                                                        <img src="{{ $data->foto }}" id="myImg2" class="zoom" data-toggle="modal" data-target="#myModal" onclick="showfoto('{{ $data->foto }}')"/>
                                                    @endif
                                                    </div>
                                                </div>

                                                <div class="row"  style="border: 1px solid #c0d6e4; min-height: 50px; margin-left: 10px; margin-right: 10px; margin-top: 10pt; border-radius: 10px; background-color: #eceef0; ">
                                                    <div class="col-12 col-lg-12">
                                                        {{ $val["jawaban"]." ?" }}
                                                    </div>
                                                </div><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-12 col-lg-12">
                          <div class="card">
                            <div class="card-content">
                                <h6 class="card-title">
                                    Jawaban Baru
                                </h6>

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                              <form action="{{ route('tanya.detail.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="pertanyaan" id="pertanyaan" value="{{ $data["id"] }}">
                                    <span class="text-danger">{{ $errors->first('pertanyaan') }}</span>

                                    <input type="file" name="foto" id="foto" title="Lampirkan Foto" placeholder="Lampirkan Foto" class="form-control">

                                    <span class="text-danger">{{ $errors->first('foto') }}</span><br>
                                    <img src="#" id="f_soal" style="height: 30%; width: 30%; margin-top: 10px; margin-bottom: 10px" data-toggle="modal" data-target="#myModal">

                                    <textarea class="form-control" placeholder="Masukan Jawaban Anda Disini" style="margin-right: 10px; min-height: 80px;" name="jawaban" id="jawaban"></textarea>

                                    <span class="text-danger">{{ $errors->first('jawaban') }}</span>

                                    <button class="btn btn-xs btn-info btn-circle pull-right" style="margin-top: 5px">
                                        <i class="fa fa-send" ata-toggle="tooltip" data-placement="left" title="Kirim Tanggapan"></i>
                                    </button><br>
                                  </div>
                              </form>

                              <button type="button" id="pay-button" class="btn btn-lg btn-success">Pay!</button>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <div class="modal-content">
          <div class="modal-body">
            <img src="" id="myImg1" class="zoom1" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
          </div>
        </div>

      </div>
    </div>

@endsection

@section('js')
<script type="text/javascript">

function showfoto(imgsrc) {
    $("#myImg1").attr("src", imgsrc);
}

$("#myImg").on("click", function()
{   
    var imgsrc = $("#myImg").attr("src");
    $("#myImg1").attr("src", imgsrc);
});

$("#f_soal").on("click", function()
{   
    var imgsrc = $("#f_soal").attr("src");
    $("#myImg1").attr("src", imgsrc);
});

</script>

<script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#f_soal').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#foto").change(function() {
      readURL(this);
    });
</script>


<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Fg_PIusIfh9cXNJu"></script>

    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
    // This is minimal request body as example.
    // Please refer to docs for all available options: 
    // https://snap-docs.midtrans.com/#json-parameter-request-body
    // TODO: you should change this gross_amount and order_id to your desire. 
    var requestBody = 
    {
      transaction_details: {
        gross_amount: 123000,
        // as example we use timestamp as order ID
        order_id: 'T-'+Math.round((new Date()).getTime() / 1000) 
      },  
      credit_card: {
        secure: true
      }
    }

    getSnapToken(requestBody, function(response){
      var response = JSON.parse(response);
      snap.pay(response.token);
    })
      };
      /**
      * Send AJAX POST request to checkout.php, then call callback with the API response
      * @param {object} requestBody: request body to be sent to SNAP API
      * @param {function} callback: callback function to pass the response
      */
      function getSnapToken(requestBody, callback) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
      if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        callback(xmlHttp.responseText);
      }
    }
    xmlHttp.open("post", "[YOUR_CHECKOUT.PHP_URL]");
    xmlHttp.send(JSON.stringify(requestBody));
      }
    </script>

@endsection