<div class="row mb-2">
    <div class="col-12 col-lg-12">
        <div class="row justify-content-between">
            <div class="col-12 col-lg-9 d-flex justify-content-start align-items-center">
                    <img src="{{ asset('img/uploads/profile')."/".$userdata->id.".jpg" }}" class="teacher-image rounded-circle mr-3" width="120px" height="120px" style="border: 5px solid #DDD; margin-top:10pt" id="imgprofile">
                    <div class="teacher-description">
                        <h5 class="mb-0">
                            <strong>
                               {{ $userdata->nama_lengkap }}
                            </strong>
                        </h5>
                        <small class="text-muted">@if($user->tipe_akun=='2') {{ "Guru" }} @else {{ "Siswa" }} @endif </small>
                        <br>
                        <small class="text-muted">
                            <i class="fas fa-map-marker-alt"></i>
                            @if($userdata->alamat_kota_domisili) 
                                {{ $kota[$userdata->alamat_kota_domisili]["nama"] }}
                            @endif
                        </small>
                        @if (isset($rating[$userdata->id]))
                            <div class="rating">
                                @for ( $i=0;  $i<$rating[$userdata->id]["rating"]; $i++)
                                    <i class="fas fa-star active"></i>
                                @endfor
                                <small>({{ $rating[$userdata->id]["rating"] }})</small>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-12 col-lg-3 mt-sm-2 d-flex justify-content-start justify-content-sm-center align-items-center">
                    <div class="btn-group">

                        {{-- <a class="btn btn-xs btn-primary">
                            Saldo
                        </a>
                        <a class="btn btn-xs btn-primary">
                            <i class="fas fa-wallet"></i> Rp. 200.000
                        </a> --}}
                    </div>
                </div>
        </div>
    </div>
</div>