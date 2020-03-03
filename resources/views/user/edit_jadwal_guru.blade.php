@extends('layouts.user_dashboard')

@section('title',"Edit Jadwal")

@section('css')

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
                Gagal Mengubah Jadwal!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="offset-2 col-8 card mb-4 bg-primary text-white">
        <form action="{{route('user.dashboard.edit_jadwal_guru.act')}}" method="post" class="row card-body">
            @csrf
            <div class="form-group col-4 font-weight-bold">
                <label for="day">Hari</label>
                <select name="day" class="form-control" id="day">
                    @foreach($jadwalDay as $nameDay => $idDay)
                        <option value="{{$idDay}}">{{$nameDay}}</option>
                    @endforeach
                </select>
                @if($errors->has('day'))
                    {{$errors->first('day')}}
                @endif
            </div>
            <div class="form-group col-3 font-weight-bold">
                <label for="timefrom">Mulai</label>
                <select name="timefrom" class="form-control" id="timefrom">
                    @for($i=7;$i<=21;$i++)
                        <option value="{{$i}}">{{sprintf('%02d',$i)}}:00</option>
                    @endfor
                </select>
                @if($errors->has('timefrom'))
                    {{$errors->first('timefrom')}}
                @endif
            </div>
            <div class="form-group col-3 font-weight-bold">
                <label for="timeto">Sampai</label>
                <select name="timeto" id="timeto" class="form-control">
                    @for($i=7;$i<=22;$i++)
                        <option value="{{$i}}">{{sprintf('%02d',$i)}}:00</option>
                    @endfor
                </select>
                @if($errors->has('timeto'))
                    {{$errors->first('timeto')}}
                @endif
            </div>
            <div class="form-group col-2 text-center">
                <button type="submit" class="btn btn-secondary" style="margin-top: 2rem">Tambah</button>
            </div>
        </form>
    </div>
    <div class="offset-sm-2 col-sm-8 mt-3 mb-5">
        <form method="post" action="{{route('user.dashboard.edit_jadwal_guru.act')}}">
            @csrf
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tbody>
                            @for($i=6;$i<=21;$i++)
                            <tr>
                                    <td>
                                        @if($i==6)
                                            -
                                        @else
                                            {{sprintf('%02d:00',$i)}} - {{sprintf('%02d:00',$i+1)}}
                                        @endif
                                    </td>
                                @foreach($jadwalDay as $nameDay => $idDay)
                                    @if($i==6)
                                        <td>{{$nameDay}}</td>
                                    @else
                                        <td id="{{$idDay.$i}}" class="jadwal" style="cursor: pointer; @if(isset($jadwal[$idDay][$i]) && $jadwal[$idDay][$i]==true) background-color: #76ff03; @endif"></td>
                                    @endif
                                @endforeach
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                    <div>
                        <p>
                            Keterangan :
                        </p>
                        <div style="width: 1rem;height: 1rem;background-color: #76ff03;display: inline-block"></div> Jadwal Bisa
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $('.jadwal').click(function () {
            var element = $(this);
            var a = element.attr('id');
            update(a,element);
        });
        
        function update(id,e) {
            $.ajax({
                method: 'POST',
                url: '{{route('user.dashboard.edit_jadwal_guru.act')}}',
                data: {_token: '{{csrf_token()}}', id:id, res:'json'}
            }).done(function (data) {
                if (data['success']) {
                    console.log("DONE");
                    if (data['type'] === 1) {
                        console.log("ADDED");
                        e.css('background-color', '#76ff03');
                    }
                    else {
                        console.log("DELETED");
                        e.css('background-color', '');
                    }
                }
            });
        }
    </script>
@endsection