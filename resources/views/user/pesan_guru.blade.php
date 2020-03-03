@extends('layouts.user_dashboard')

@section('title',"Pesan Guru Privat")

@php
    /** @var \App\MataPelajaran[] $matpel */
    /** @var \App\User|\App\UserData $guru */
@endphp

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <style>
        .jadwal-row{margin-left: 0 !important;margin-right: 0!important;}
        .invalid-feedback{display: block!important;}
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
    <div class="offset-lg-4 col-lg-4 offset-sm-2 col-sm-8 mt-3 mb-5">
        <form method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                    Pesan Guru Privat
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Detail Guru</label>
                        <div>{{$guru->nama_lengkap}}</div>
                        <div>{{$rating}}</div>
                    </div>
                    <div class="form-group">
                        <label for="matpel">Mata Pelajaran</label>
                        <select id="matpel" class="form-control" name="matpel">
                            <option selected disabled>-</option>
                            @foreach($mpg as $itemMatpel)
                                <option value="{{$itemMatpel->id}}" @if($itemMatpel->id==old('matpel')) selected @endif>{{$itemMatpel->matpel->nama." ".$itemMatpel->matpel->jenjang->nama." ".$itemMatpel->matpel->jenjang->tingkat}} - Rp {{$itemMatpel->tarif}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('matpel'))
                            <div class="invalid-feedback">
                                {{$errors->first('matpel')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="jmlPertemuan">Jumlah Pertemuan</label>
                        <div class="input-group">
                            <select id="jmlPertemuan" class="form-control" type="number" name="jmlPertemuan">
                                <option selected disabled>-</option>
                                @for($i=5;$i<=15;$i++)
                                <option value="{{$i}}" @if($i==old('jmlPertemuan')) selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        @if($errors->has('jmlPertemuan'))
                            <div class="invalid-feedback">
                                {{$errors->first('jmlPertemuan')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="durasiPertemuan">Durasi Per Pertemuan</label>
                        <div class="input-group">
                            <select id="durasiPertemuan" class="form-control" type="number" name="durasiPertemuan">
                                <option selected disabled>-</option>
                                <option value="1" @if(old('durasiPertemuan')==1) selected @endif>1 jam</option>
                                <option value="2" @if(old('durasiPertemuan')==2) selected @endif>1,5 jam</option>
                                <option value="3" @if(old('durasiPertemuan')==3) selected @endif>2 jam</option>
                                <option value="4" @if(old('durasiPertemuan')==4) selected @endif>2,5 jam</option>
                                <option value="5" @if(old('durasiPertemuan')==5) selected @endif>3 jam</option>
                            </select>
                        </div>
                        @if($errors->has('durasiPertemuan'))
                            <div class="invalid-feedback">
                                {{$errors->first('durasiPertemuan')}}
                            </div>
                        @endif
                    </div>
                    <div id="jadwalPertemuan">
                        @for($i=0;$i<15;$i++)
                            <div class="form-group" style="display: none;">
                                <label>Atur Jadwal Pertemuan Ke-{{$i+1}}</label>
                                <div class="row jadwal-row">
                                    <input type="text" class="form-control col-7 datepicker" autocomplete="disable" name="tglOrder[{{$i}}]" disabled placeholder="mm/dd/yyyy" value="{{empty(old('tglOrder')[$i])?"":old('tglOrder')[$i]}}">
                                    <select class="form-control offset-1 col-4" name="jamOrder[{{$i}}]" disabled>
                                        <option selected value="">-</option>
                                        @for($j=7;$j<=20;$j++)
                                            <option value="{{$j}}" @if(!empty(old('jamOrder')[$i]) && old('jamOrder')[$i]==$j) selected @endif>{{sprintf('%02d',$j)}}:00</option>
                                        @endfor
                                    </select>
                                </div>
                                @if($errors->has('tglOrder'.$i))
                                    <div class="invalid-feedback">
                                    {{$errors->first('tglOrder'.$i)}}
                                    </div>
                                @endif
                            </div>
                        @endfor
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" class="form-control" placeholder="Alamat" name="alamat" value="{{old('alamat')}}">
                        @if($errors->has('alamat'))
                            <div class="invalid-feedback">
                            {{$errors->first('alamat')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select class="form-control" name="provinsi" id="provinsi">
                            <option value="">-</option>
                        @foreach(\App\Provinsi::all() as $provinsi)
                                <option value="{{$provinsi->id}}" {{$provinsi->id==old('provinsi')?"selected":""}}>{{$provinsi->nama}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('provinsi'))
                            <div class="invalid-feedback">
                            {{$errors->first('provinsi')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="kota">Kota/Kabupaten</label>
                        <select class="form-control" name="kota" id="kota">
                            <option value="">-</option>
                            @if(old('provinsi'))
                                @foreach(\App\KotaKab::whereIdProvinsi(old('provinsi'))->get() as $kota)
                                    <option value="{{$kota->id}}" {{$kota->id==old('kota')?"selected":""}}>{{$kota->nama}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if($errors->has('kota'))
                            <div class="invalid-feedback">
                            {{$errors->first('kota')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <select name="kecamatan" class="form-control" id="kecamatan">
                            <option value="">-</option>
                            @if((old('provinsi') && old('kota')))
                                @foreach(\App\Kecamatan::whereIdKota(old('kota'))->get() as $kec)
                                    <option value="{{$kec->id}}" {{$kec->id==old('kecamatan')?"selected":""}}>{{$kec->nama}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if($errors->has('kecamatan'))
                            <div class="invalid-feedback">
                            {{$errors->first('kecamatan')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('user.dashboard.keahlian.index')}}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker').datepicker();
            updateJadwal($('#jmlPertemuan').val());
        });
        $('#jmlPertemuan').change(function () {
            var jml = $(this).val();
            updateJadwal(jml);
        });
        function updateJadwal(jml) {
            var child = $('#jadwalPertemuan').children();
            $.each(child,function (i) {
                if (i<jml) {
                    child.eq(i).css('display', 'block');
                    child.eq(i).find('input').prop('disabled',false);
                    child.eq(i).find('select').prop('disabled',false);
                }
                else {
                    child.eq(i).css('display', 'none');
                    child.eq(i).find('input').prop('disabled', true);
                    child.eq(i).find('select').prop('disabled', true);
                }
            })
        }
        var p = $('#provinsi');
        var k = $('#kota');
        var c = $('#kecamatan');

        p.change(function () {
            emptyOption(k);
            emptyOption(c);
            update(true,p,k,c);
        });
        k.change(function () {
            emptyOption(c);
            update(false,p,k,c);
        });
        function emptyOption(select) {
            select.empty();
            select.append($("<option></option>").attr('value', '').text('-'));
        }
        function update(isP,p,k,c) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            $.ajax({
                method: 'POST',
                async: true,
                url: '{{route('user.api.getDistrict')}}',
                data: {a: p.val(), b:k.val()},
            }).done(function (data) {
                if (data['success']) {
                    if(data['kota'].length>0 && isP) {
                        emptyOption(k);
                        $.each(data['kota'], function (key, value) {
                            console.log(value);
                            k.append($("<option></option>").attr('value', value['id']).text(value['nama']));
                        });
                    }
                    if(data['kec'].length>0) {
                        emptyOption(c);
                        $.each(data['kec'], function (key, value) {
                            console.log(value);
                            c.append($("<option></option>").attr('value', value['id']).text(value['nama']));
                        });
                    }
                }
            });
        }
    </script>
@endsection