@extends('layouts.user_dashboard')

@section('title',"Edit Profil")

@section('css')
    <style>
        select,input{display: block}
    </style>
@endsection

@section('content')
     <main style="margin-top:-55px">
        <div class="section-area">
            <div class="jumbotron jumbotron-fluid jumbotron-profile">
                <img src="" class="img-fluid" style="width: 100%;">
            </div>
        </div>
        <section class="teacher-profile">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card mb-4">
                            <div class="card-body pb-0"> 
                                @include('user.foto')
                                <div class="row">
                                    <div class="menu-profile">
                                        <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">
                                                    Profil
                                                </a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="true">
                                                    Ubah Kata Sandi
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @if (Session::has('success'))
                                       <div class="alert alert-success" role="alert">
                                           {{Session::get('success')}}
                                       </div>
                                  @elseif (Session::has('error'))
                                       <div class="alert alert-danger" role="alert">
                                           {{Session::get('error')}}
                                       </div>
                                  @endif

                                <form action="{{ route('user.dashboard.edit_profile.act') }}" method="POST" enctype="multipart/form-data">
                                <div class="tab-content border-0 bg-white" id="v-pills-tabContent myaccountContent">
                                    <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                        <div class="title-tab">
                                            <h3 class="mb-0">
                                                Profil
                                            </h3>
                                            <button type="submit" class="btn btn-primary">
                                                Simpan
                                            </button>
                                        </div>
                                        <div class="row">
                                            @csrf
                                            <div class="col-12 col-lg-4 mb-sm-3">
                                                <label for=""><h6>Foto Profil</h6></label>
                                                <input type="file" class="dropify" data-height="140" name="foto" id="foto" />
                                            </div>
                                            <div class="col-12 col-lg-8">
                                                <div class="form-group">
                                                    <label for=""><h6>Nama Lengkap *</h6></label>
                                                    <input type="text"
                                                        class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="@if ($userdata){{  $userdata->nama_lengkap }} @endif" required="required">
                                                    <span class="text-danger">{{ $errors->first('nama_lengkap') }}</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><h6>Nama Panggilan *</h6></label>
                                                    <input type="text"
                                                        class="form-control" name="nama_panggilan" id="nama_panggilan"  placeholder="Nama Panggilan" value="@if ($userdata){{  $userdata->nama_panggilan }} @endif" required="required">
                                                    <span class="text-danger">{{ $errors->first('nama_panggilan') }}</span>
                                                </div>

                                            </div>
                                        </div>
 
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for=""><h6>Nomor Identitas</h6></label>
                                                    <p style="font-size:8pt; margin-top:-10pt; color:orange">(KTP / SIM / KITAS / KARTU PELAJAR / KARTU MAHASISWA)</p>
                                                    <input type="text"
                                                        class="form-control" name="no_identitas" id="no_identitas" aria-describedby="helpId" placeholder="Nomor Identitas" value="@if ($userdata){{  $userdata->no_identitas }} @endif" required="required">
                                                    <span class="text-danger">{{ $errors->first('no_identitas') }}</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for=""><h6>Scan/Foto Kartu Identitas @if($user->tipe_akun==2) * @endif</h6></label>
                                                    <p style="font-size:8pt; margin-top:-10pt; color:orange">(Upload Scan/Foto Kartu Identitas)</p>
                                                    <input type="file" name="foto_identitas" id="foto_identitas" @if($user->tipe_akun==2 && !isset($userdata->foto_identitas)) required="required" @endif/>

                                                    <span class="text-danger">{{ $errors->first('foto_identitas') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for=""><h6>Jenis Kelamin *</h6></label>
                                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                        <option value="Laki-Laki">Laki-Laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                    <span class="text-danger">{{ $errors->first('jenis_kelamin') }}</span>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                 <div class="form-group">
                                                    <label for="notelp"><h6>Nomor Handphone *</h6></label>
                                                    <input type="text"
                                                        class="form-control" name="no_hp" id="no_hp" placeholder="Nomor Telephone" value="@if ($userdata){{  $userdata->no_hp }} @endif">
                                                    <span class="text-danger">{{ $errors->first('no_hp') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for=""><h6>Asal Sekolah</h6></label>
                                                    <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah" placeholder="Asal Sekolah" value="@if ($userdata){{  $userdata->asal_sekolah }} @endif">
                                                    <span class="text-danger">{{ $errors->first('asal_sekolah') }}</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for=""><h6>Status Sekolah</h6></label>
                                                    <select class="form-control" name="status_sekolah" id="status_sekolah">
                                                        <option value="0" @if ($userdata->status_sekolah==0) selected @endif>Lulus</option>
                                                        <option value="1" @if ($userdata->status_sekolah==1) selected @endif>Berjalan</option>
                                                    </select>
                                                    <span class="text-danger">{{ $errors->first('status_sekolah') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for=""><h6>Pendidikan Terakhir / Pendidikan Sekarang *</h6></label>
                                                    <select class="form-control" name="jenjang_pendidikan" id="jenjang_pendidikan">
                                                            @foreach($jenjang as $key => $val)
                                                            <option value="{{ $val['id'] }}" @if ($userdata->jenjang_pendidikan==$val['id']) selected @endif>{{ $val['nama'] }} - {{$val['tingkat']}}</option> 
                                                            @endforeach
                                                    </select>
                                                    <span class="text-danger">{{ $errors->first('jenjang_pendidikan') }}</span>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="tempat_lahir"><h6>Tempat Lahir</h6></label>
                                                    <input type="text"
                                                        class="cari form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="@if($userdata->tempat_lahir) {{ $kota[$userdata->tempat_lahir]["nama"] }} @endif">

                                                    <input type="hidden" name="tempat_lahir_id" id="tempat_lahir_id" value="
                                                    @if($userdata->tempat_lahir) {{ $userdata->tempat_lahir }} @endif">
                                                    </div>
                                                    <span class="text-danger">{{ $errors->first('tempat_lahir') }}</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="notelp"><h6>Tanggal Lahir*</h6></label>
                                                    <input type="text"
                                                        class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="@if ($userdata->tanggal_lahir){{ $userdata->tanggal_lahir }} @endif">
                                                    <span class="text-danger">{{ $errors->first('tanggal_lahir') }}</span>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for=""><h6>Kota Asal *</h6></label>
                                                    <input type="text"
                                                        class="cari form-control" name="alamat_kota" id="alamat_kota" placeholder="Kota Asal" value="@if ($userdata->alamat_kota){{ $kota[$userdata->alamat_kota]["nama"] }} @endif">

                                                    <input type="hidden" name="alamat_kota_id" id="alamat_kota_id" value="@if ($userdata->alamat_kota){{ $userdata->alamat_kota }} @endif">

                                                    <span class="text-danger">{{ $errors->first('alamat_kota') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for=""><h6>Alamat Jalan (Asal) *</h6></label>
                                                    <input type="text" class="form-control" name="alamat_jalan" id="alamat_jalan" value="@if ($userdata->alamat_jalan){{  $userdata->alamat_jalan }} @endif" placeholder="Alamat Jalan">
                                                    <span class="text-danger">{{ $errors->first('alamat_jalan') }}</span>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for=""><h6>Kota Domisili *</h6></label>
                                                    <input type="text"
                                                        class="cari form-control" name="alamat_kota_domisili" id="alamat_kota_domisili" placeholder="Kota Domisili" value="@if ($userdata->alamat_kota_domisili){{ $kota[$userdata->alamat_kota_domisili]["nama"] }} @endif">

                                                    <input type="hidden" name="alamat_kota_domisili_id" id="alamat_kota_domisili_id" value="@if ($userdata->alamat_kota_domisili){{ $userdata->alamat_kota_domisili }} @endif">
                                                    <span class="text-danger">{{ $errors->first('alamat_kota_domisili') }}</span>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for=""><h6>Alamat Jalan (Domisili) *</h6></label>
                                                    <input type="text" class="form-control" name="alamat_jalan_domisili" id="alamat_jalan_domisili" value="@if ($userdata->alamat_jalan_domisili){{  $userdata->alamat_jalan_domisili }} @endif" placeholder="Alamat Jalan Domisili">
                                                    <span class="text-danger">{{ $errors->first('alamat_jalan_domisili') }}</span>
                                                </div>
                                            </div>

                                            @if ($user->tipe_akun==2)
                                                <div class="col-12 col-lg-6">
                                                    <div class="form-group">
                                                        </i><label class="code" style="margin-left:6px"><h6>Video Profile :</h6></label><br>
                                                        <input type="text" name="link" class="form-control" id="link" value="@if ($userdata->link){{ $userdata->link }} @endif" placeholder="Masukan Video Profile">
                                                        <span class="text-danger">{{ $errors->first('link(target, link)') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="form-group">
                                                        </i><label class="code" style="margin-left:6px"><h6>Deskripsi Pribadi :</h6></label><br>
                                                        <textarea style="padding-right:20px; min-height:150px; background:#fafafa" class="form-control" id="deskripsi" name="deskripsi" maxlength="200" placeholder="Deskripsikan diri anda seperti pengalaman mengajar, menguasai mata pelajaran apa saja, sedang menempuh study dimana atau prestasi yang pernah anda raih">{{  $userdata->deskripsi }}</textarea>

                                                        <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    </form>

                                    
                                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                        <form action="{{ route('user.dashboard.editpassword') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="title-tab">
                                            <h3 class="mb-0">
                                                Ubah Kata Sandi
                                            </h3>
                                            <button type="submit" class="btn btn-primary">
                                                Simpan
                                            </button>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kata Sandi Saat Ini *</label>
                                            <input type="password"
                                                class="form-control" name="pass" id="pass" aria-describedby="helpId" placeholder="Masukan Password Saat Ini">
                                            <span class="text-danger">{{ $errors->first('pass') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kata Sandi Baru *</label>
                                            <input type="password" placeholder="Password Baru" class="form-control input" name="password" id="password"  required />
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Konfirmasi Kata Sandi Baru *</label>
                                            <input type="password" placeholder="Ketik Ulang Password Baru" class="form-control input" name="password_confirmation" id="password_confirmation"  required />
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <div class="modal fade" id="jadwalGuru" tabindex="-1" role="dialog" aria-labelledby="jadwalGuruLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jadwalGuruLabel">Edit Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <select class="form-control select2" name="" id="">
                            <option>Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Jadwal</label>
                        <select class="form-control select2" name="" id="">
                            <option>Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Hari Mengajar</label>
                        <input type="date" class="form-control" name="" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Jam Mengajar</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="time" class="form-control" name="" id="">
                            </div>
                            <div class="col-6">
                                <input type="time" class="form-control" name="" id="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default">Save changes</button>
                </div>
                </div>
            </div>
        </div>

        @include('landing.footer')
    </main>
@endsection

@section('js')
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script type="text/javascript">
        $('#tempat_lahir').autocomplete({
            source:'{!!URL::route('dashboard.loadKota')!!}',
              minlength:1,
              autoFocus:true,
              select:function(e,ui)
              {
                  $('#tempat_lahir').val(ui.item.value);
                  $('#tempat_lahir_id').val(ui.item.kode_kota);
              }
        });

        $('#alamat_kota_domisili').autocomplete({
            source:'{!!URL::route('dashboard.loadKota')!!}',
              minlength:1,
              autoFocus:true,
              select:function(e,ui)
              {
                  $('#alamat_kota_domisili').val(ui.item.value);
                  $('#alamat_kota_domisili_id').val(ui.item.kode_kota);
              }
        });  


        $('#alamat_kota').autocomplete({
            source:'{!!URL::route('dashboard.loadKota')!!}',
              minlength:1,
              autoFocus:true,
              select:function(e,ui)
              {
                  $('#alamat_kota').val(ui.item.value);
                  $('#alamat_kota_id').val(ui.item.kode_kota);
              }
        }); 

        $( "#tanggal_lahir" ).click(function() {
            $('#tanggal_lahir').attr('type', 'date');
        });
    </script>
@endsection