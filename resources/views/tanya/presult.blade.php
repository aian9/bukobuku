<div class="content">
    <div class="container">
          <div class="row">
              @foreach($data as $key => $value)
                <div class="col-xs-12 col-sm-4">
                    <div class="card">
                        <div class="card-content">
                            <h6 class="card-title">
                                <a href="http://www.fostrap.com/2016/03/bootstrap-3-carousel-fade-effect.html">
                                  {{ $value["judul"] }}
                              </a>
                            </h6>
                            <a href="{{ url('tanya/detail'."/".$value["id"]) }}">
                            @if(file_exists('storage/uploads/tanya/'.$value["foto"]))
                                <img src="{{ asset('/storage/uploads/tanya'."/".$value["foto"]) }}" class="zoom" />
                            @else
                                <img src="{{ $value["foto"] }}" class="zoom" />
                            @endif
                            </a>
                            <p class="">
                                {{ $value["pertanyaan"] }}
                            </p>
                        </div>
                        <div class="card-read-more col-sm-12">

                            <div class="btn-group">
                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span> <i class="fa fa-gear"></i></button>
                              <ul class="dropdown-menu" role="menu">
                                <li>
                                  <a href="{{ url('tanya/detail'."/".$value["id"]) }}" style="color: #007bff"><i class="fa fa-eye"></i> Detail</a>
                                </li>
                                @if($value["id_murid"]==$user->id)
                                <li>
                                  <a href="{{ url('tanya/edit'."/".$value["id"]) }}" style="color: orange"><i class="fa fa-pencil"></i> Edit</a>
                                </li>
                                <li>
                                  <a href="{{ url('tanya/delete'."/".$value["id"]) }}" style="color: red"><i class="fa fa-remove"></i> Hapus</a>
                                </li>
                                @endif
                              </ul>
                            </div>

                            <button class="btn btn-lg " data-toggle="tooltip" data-placement="bottom" title="Jawaban Guru"><i class="fa fa-pencil"></i> 10</button>

                            <button class="btn btn-lg" data-toggle="tooltip" data-placement="bottom" title="Respon Guru">  <i class="fa fa-users"></i> 12</button>
                        </div>
                    </div>
                </div>
                @endforeach

                @if(isset($edit))
                <div class="col-xs-12 col-sm-4">
                    <div class="card">
                        <div class="card-content">
                            <h6 class="card-title">
                                {{ $edit->judul }}
                            </h6>

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('tanya.update') }} " method="POST" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="id_tanya" value="{{ $edit->id }}">
                               <span class="text-danger">{{ $errors->first('id_tanya') }}</span>
                              <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Pertanyaan (Max 50 Karakter)" maxlength="100" required="true" value="{{ $edit->judul }}">
                              <span class="text-danger">{{ $errors->first('judul') }}</span><br>

                              <input type="file" name="foto" id="foto" title="Lampirkan Foto" placeholder="Lampirkan Foto" class="form-control">

                              <span class="text-danger">{{ $errors->first('foto') }}</span><br>
                              @if(file_exists('storage/uploads/tanya/'.$edit->foto))
                              <img src="{{ asset('/storage/uploads/tanya'."/".$edit->foto) }}" id="f_soal" style="height: 50%; width: 50%; margin-top: 10px; margin-bottom: 10px">
                              @else
                              <img src="{{ $edit->foto }}" id="f_soal" style="height: 50%; width: 50%; margin-top: 10px; margin-bottom: 10px">
                              @endif
                              <textarea class="form-control" placeholder="Masukan Pertanyaan (Max 200 Karakter)" maxlength="200" style="min-height: 150px; margin-bottom: 10px" required="true" id="tanya" name="tanya">{{ $edit->pertanyaan }}</textarea>
                              <span class="text-danger">{{ $errors->first('tanya') }}</span>

                              <a href="{{ route('tanya.pertanyaan') }}" class="btn btn-md btn-danger">
                                <i class="fa fa-remove"></i> Batal
                              </a>

                              <button type="submit" class="btn btn-md btn-success pull-right">
                                  <i class="fa fa-check"></i> Simpan
                              </button>

                            </form>
                            <br>
                        </div>

                    </div>
                </div>
                @elseif(!isset($edit) and $user->tipe_akun!=2)

                <div class="col-xs-12 col-sm-4">
                    <div class="card">
                        <div class="card-content">
                            <h6 class="card-title">
                                Pertanyaan Baru
                            </h6>

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('tanya.store') }} " method="POST" enctype="multipart/form-data">
                              @csrf
                              <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Pertanyaan (Max 50 Karakter)" maxlength="100" required="true">
                              <span class="text-danger">{{ $errors->first('judul') }}</span><br>

                              <input type="file" name="foto" id="foto" title="Lampirkan Foto" placeholder="Lampirkan Foto" class="form-control">

                              <span class="text-danger">{{ $errors->first('foto') }}</span><br>
                              <img src="#" id="f_soal" style="height: 50%; width: 50%; margin-top: 10px; margin-bottom: 10px">
                              <textarea class="form-control" placeholder="Masukan Pertanyaan (Max 200 Karakter)" maxlength="200" style="min-height: 150px; margin-bottom: 10px" required="true" id="tanya" name="tanya"></textarea>
                              <span class="text-danger">{{ $errors->first('tanya') }}</span>

                              <button type="submit" class="btn btn-md btn-success pull-right">
                                  <i class="fa fa-check"></i> Tanyakan
                              </button>
                            </form>
                            <br><br>
                        </div>

                    </div>
                </div>

                @endif
          </div>
    </div>

    <div class="container">
          <ul class="pagination pull-right">
             {{ $data->links() }}
          </ul>
      </div>
</div><br><br>
