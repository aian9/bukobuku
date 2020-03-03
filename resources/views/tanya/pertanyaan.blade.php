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
      max-height: 100%; 
      max-width: 100%;
      margin: 0 auto;
    }

    .zoom:hover {
      transform: scale(1.4); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
      position:relative;
      display:block;
      z-index: 5;
    }

    
</style>
@endsection

@section('content')

<main>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="status-card mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div class="">
                                        <h1 class="mb-3">800</h1>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>
                                                <h5 class="mb-0">Pertanyaan</h5>
                                                <small>800 Pertanyaan</small>
                                            </span>
                                            <i class="fa fa-pencil big-icon" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div class="">
                                        <h1 class="mb-3">50</h1>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>
                                                <h5 class="mb-0">Guru</h5>
                                                <small>50 Guru Siap Menjawab</small>
                                            </span>
                                            <i class="fa fa-users big-icon" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div class="">
                                        <h1 class="mb-3">800</h1>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>
                                                <h5 class="mb-0">Dijawab</h5>
                                                <small>800 Pertanyaan Dijawab</small>
                                            </span>
                                            <i class="fa fa-credit-card big-icon" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div class="">
                                        <h1 class="mb-3">750</h1>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>
                                                <h5 class="mb-0">Sesuai</h5>
                                                <small>750 Jawaban Sesuai</small>
                                            </span>
                                            <i class="fa fa-check big-icon" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header"><br>
                                <h4 class="card-title text-left" style="margin-left: 16px"><strong>Daftar Pertanyaan</strong></h4>

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="col-md-5 text-center">
                                    <form action="{{ route('tanya.pertanyaan') }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-3">
                                      <input type="text" class="form-control" placeholder="Judul Pertanyaan" aria-label="Recipient's username" aria-describedby="basic-addon2" id="s_judul" name="s_judul">
                                      <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                      </div>
                                      </form>
                                    </div>
                                </div>

                            </div>

                            @include("tanya.presult")

                            <br>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

@section('js')
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


    $( document ).ready(function() {
        $("#wrapper").toggleClass("toggle");
    });
</script>

@endsection