<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav menu">
        {{-- <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
                <b>Beranda</b>
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="{{route('about')}}" class="btn btn-header hidden-sm hidden-xs" style="background:#a82932;-webkit-box-shadow: 0 0 20px #a829327a;
            box-shadow: 0 0 20px #a829327a;margin-right: 20px">
                <b>Tentang Kami</b>
            </a>
        </li>
        {{----------------------------- LINK UNTUK TANYA GURU -----------------------------}}
        {{-- @if(Auth::check())
        <li class="nav-item">
            <a href="{{route('tanya.dashboard')}}" class="nav-link">
                <b>Tanya Guru</b>
            </a>
        </li>
        @endif --}}
        

        @if(Auth::user())
        @if(auth()->user()['tipe_akun']=='2')
        <li class="nav-item">
            <a href="{{route('user.dashboard.jadwal.act')}}" class="nav-link">
                <b>Jadwal Mengajar</b>
            </a>
        </li>
        @elseif(auth()->user()['tipe_akun']!='2')
        <li class="nav-item">
            <a href="{{route('listguru')}}" class="nav-link">
                <b>Cari Guru</b>
            </a>
        </li>
        @endif
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="profile-dropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <b>{{ \Auth::user()->username }}</b>  
                <i class="fas fa-user-circle" style="margin-left: 10pt"></i>
            </a>
            <div class="dropdown-menu">
                <ul class="dropdown-account">
                    @if(auth()->user()['tipe_akun']=='1')
                    <li style="list-style-type:none;">
                        <i class="fas fa-shopping-cart" style="margin-left: -10pt"></i>
                        <a href="{{route('user.dashboard.order')}}" class="nav-link" style="margin-left: -10pt; margin-top:-25pt">
                        Order
                        @if(Session::get("total")>0)
                        <h6 class="notify">
                            <center><b>{{ Session::get("total") }}</b></center>
                        </h6>
                        @endif
                        </a>
                    </li>
                    @elseif(auth()->user()['tipe_akun']=='2')
                    <li style="list-style-type:none;">
                        <i class="fas fa-shopping-cart" style="margin-left: -10pt"></i>
                        <a href="{{route('user.dashboard.listorder')}}" class="nav-link" style="margin-left: -10pt; margin-top:-25pt">Order
                        @if(Session::get("total")>0)
                        <h6 class="notify">
                            <center><b>{{ Session::get("total") }}</b></center>
                        </h6>
                        @endif
                        </a>
                    </li>
                    @endif
                    <li style="list-style-type:none;">
                        <i class="fas fa-user-circle" style="margin-left: -10pt"></i>
                        <a href="{{route('user.dashboard.edit_profile')}}" class="nav-link" style="margin-left: -10pt; margin-top:-25pt">Profil</a>
                    </li>
                    <li style="list-style-type:none;">
                        <i class="fas fa-sign-out-alt" style="margin-left: -10pt"></i>
                        <a href="{{route('logout')}}" class="nav-link" style="margin-left: -10pt; margin-top:-25pt">Logout</a>
                    </li>
                </ul>
            </div>
        </li>
        @else
        <li class="nav-item">
            <a class="btn btn-header hidden-sm hidden-xs" href="{{route('login')}}" style="margin-right: 20px">
                Masuk
            </a>
        </li>
        @endif
    </ul>
</div>