@extends('layouts.user_dashboard')

@section('title',"Daftar Pesanan")

@php
    /** @var \App\Order[] $order */
    /** @var \App\OrderDate $order_date */
@endphp

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <style>
        .jadwal-row{margin-left: 0 !important;margin-right: 0!important;}
        .invalid-feedback{display: block!important;}
        .star-rating .ic{
            cursor: pointer;
            color: #d7ba00;
        }
        .star-rating-review .ic{
            color: #d7ba00;
        }
        .star-rating{
            text-align: center;
        }
        .link, .link:hover{
            color: inherit;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="offset-lg-4 col-lg-4 offset-sm-2 col-sm-8 mt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$errors->first()}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="offset-lg-3 col-lg-6 offset-sm-2 col-sm-8 mt-3 mb-5">
        @foreach($order as $item)
            <div class="col-8 offset-2 mt-3">
                <div class="card @if($item->status < 0) text-white bg-danger @elseif($item->status == \App\Order::STATUS_GURU_ACCEPTED) text-white bg-primary @endif">
                    <a href="{{route('user.dashboard.invoice',$item->no_invoice())}}" class="link">
                    <div class="card-header">
                        Invoice {{$item->no_invoice()}}
                    </div>
                    <div class="card-body">
                        <label for="" class="font-weight-bold">Nama Guru</label>
                        <p>{{$item->guru->nama_lengkap}}</p>
                        <label for="" class="font-weight-bold">Tempat Belajar</label>
                        <p>{{$item->order_dates[0]->alamat_jalan}}, {{$item->order_dates[0]->kecamatan->nama}}, {{$item->order_dates[0]->kecamatan->kota->nama}}, {{$item->order_dates[0]->kecamatan->kota->provinsi->nama}}</p>
                        <label for="" class="font-weight-bold">Status Pesanan</label>
                        <p>{{$item->statusText()}}</p>
                        <label for="" class="font-weight-bold">Tanggal Belajar</label>
                        <ul>
                            @foreach($item->order_dates as $order_date)
                                <li>{{\Carbon\Carbon::parse($order_date->datetime)->formatLocalized('%d %B %Y %H:%M')}}</li>
                            @endforeach
                        </ul>

                        @if($item->status == \App\Order::STATUS_DONE && !empty($item->review))
                            <label for="" class="font-weight-bold">Ulasanmu</label>
                            <p class="star-rating-review">
                                @for($i=0;$i<$item->review->rating;$i++)
                                    <span class="ic fa fa-star"></span>
                                @endfor
                                @for($i=0;$i<5-$item->review->rating;$i++)
                                    <span class="ic far fa-star"></span>
                                @endfor
                            </p>
                            <p>{{$item->review->review}}</p>
                        @endif
                    </div>

                    </a>
                    @if(($item->status >= \App\Order::STATUS_WAITING_PAYMENT && $item->status < \App\Order::STATUS_DONE) || $item->status == \App\Order::STATUS_DONE && empty($item->review))
                    <div class="card-footer">
                        @if($item->status >= \App\Order::STATUS_WAITING_PAYMENT && $item->status <= \App\Order::STATUS_PAYMENT_VERIFIED)
                        <form method="post" action="{{route('user.dashboard.order_cancel')}}" style="display: inline-block;" class="form-abort">
                            @csrf
                            <button class="btn btn-danger" type="submit" name="id" value="{{$item->id}}">Batalkan Pesanan</button>
                        </form>
                        @endif
                        @if($item->status == \App\Order::STATUS_GURU_ACCEPTED && \Carbon\Carbon::now()->gte(\Carbon\Carbon::parse($item->order_dates->last()->datetime_end)))
                        <form method="post" action="{{route('user.dashboard.order_done')}}" style="display: inline-block">
                            @csrf
                            <button class="btn btn-success" type="submit" name="id" value="{{$item->id}}">Selesai Belajar</button>
                        </form>
                        @endif
                        @if($item->status == \App\Order::STATUS_DONE && empty($item->review))
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#review{{$item->id}}">Tulis Review</button>

                        <div class="modal fade text-dark" id="review{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="Review" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="{{route('user.dashboard.order_review')}}" class="form-review" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tulis Review</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger review-alert" style="display: none;"></div>
                                            <div class="star-rating mb-4">
                                                <span class="ic far fa-star" data-rating="1"></span>
                                                <span class="ic far fa-star" data-rating="2"></span>
                                                <span class="ic far fa-star" data-rating="3"></span>
                                                <span class="ic far fa-star" data-rating="4"></span>
                                                <span class="ic far fa-star" data-rating="5"></span>
                                                <input type="hidden" name="rating" class="rating-value" value="0">
                                            </div>
                                            <div>
                                                <textarea name="review" id="review" cols="30" rows="10" class="form-control" placeholder="Tulis disini"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary" type="submit" name="id" value="{{$item->id}}">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($item->status >= \App\Order::STATUS_WAITING_PAYMENT && $item->status < \App\Order::STATUS_DONE)
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#report{{$item->id}}">Laporkan Masalah</button>

                        <div class="modal fade text-dark" id="report{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="Report" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="{{route('user.dashboard.order_report.act')}}" class="form-report" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Laporkan Masalah</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger report-alert" style="display: none;"></div>
                                            <div class="form-group">
                                                <label for="subject">Subject Masalah</label>
                                                <input type="text" class="form-control" name="subject" placeholder="contoh : Guru tidak hadir, Guru tidak datang tepat waktu" maxlength="100" id="subject" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="review">Deskripsi Masalah</label>
                                                <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Jelaskan kronologis lengkap masalah tersebut" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary" type="submit" name="id" value="{{$item->id}}">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        var $star_rating = $('.star-rating .ic');

        var SetRatingStar = function() {
            return $star_rating.each(function() {
                if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                    return $(this).removeClass('far').addClass('fa');
                } else {
                    return $(this).removeClass('fa').addClass('far');
                }
            });
        };

        $star_rating.on('click', function() {
            $star_rating.siblings('input.rating-value').val($(this).data('rating'));
            return SetRatingStar();
        });

        $('.form-review').submit(function (e) {
            var star = $(this).find('input.rating-value').val();
            if (star>0 && star<=5)
                return true;
            var review_alert = $(this).find('div.review-alert');
            review_alert.html('Bintang harus dipilih!');
            review_alert.css('display','block');
            e.preventDefault();
        });

        $('.form-abort').submit(function (e) {
            if(confirm('Apakah kamu yakin ingin membatalkan pesanan ini?'))
                return true;
            e.preventDefault();
        });

        SetRatingStar();
        $(document).ready(function() {

        });
    </script>
@endsection