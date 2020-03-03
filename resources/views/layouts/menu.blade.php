<aside class="sidebar" id="sidebar">
        <a class="navbar-brand d-lg-block d-md-block d-block" id="navbar" href="{{route('admin.dashboard')}}">
            <img src="{{ asset('admin/assets/img/logo/logo-small.png') }}" alt="logo" class="img-rectangle" />
            <img src="{{ asset('admin/assets/img/logo/logo-square.png') }}" alt="logo" class="img-square" />
        </a>
        <!-- Sidebar scroll-->
            <div class="sidebar-scroll" id="sidebar-scroll">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebar-navigation" class="in">
                        <li data-toggle="tooltip" data-placement="right" title="Dashboard" style="position: relative;">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-chart-line"></i>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="right" title="List Order" style="position: relative;">
                            <a href="{{ route('admin.listorder') }}">
                                <i class="fas fa-archive"></i>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="right" title="Data Tagihan" style="position: relative;">
                            <a href="{{ route('admin.listtagihan') }}">
                                <i class="fas fa-money-bill-wave"></i>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="right" title="Verifikasi Transfer" style="position: relative;">
                            <a href="{{ route('admin.listtransaksi') }}">
                                <i class="fas fa-money-bill-wave"></i>
                            </a>
                        </li>

                        <li data-toggle="tooltip" data-placement="right" title="Verifikasi Profile Guru" style="position: relative;">
                            <a href="{{ route('admin.listguru') }}">
                                <i class="fas fa-users"></i>
                            </a>
                        </li>

                        <li data-toggle="tooltip" data-placement="right" title="Pengaduan" style="position: relative;">
                            <a href="{{ route('admin.pengaduan') }}">
                                <i class="fa fa-volume-up" style="font-size:20px"></i>
                            </a>
                        </li>
                        
                        <li data-toggle="tooltip" data-placement="right" title="Users" style="position: relative;">
                            <a href="{{ route('admin.listuser') }}">
                                <i class="fas fa-user-cog" style="font-size:20px"></i>
                            </a>
                        </li>
                        
                        <li data-toggle="tooltip" data-placement="right" title="Provinsi" style="position: relative;">
                            <a href="{{ route('admin.listprovinsi') }}">
                                <i class="fas fa-map-marked-alt" style="font-size:20px"></i>
                            </a>
                        </li>
                        
                        <li data-toggle="tooltip" data-placement="right" title="Kota" style="position: relative;">
                            <a href="{{ route('admin.listkota') }}">
                                <i class="fas fa-city" style="font-size:20px"></i>
                            </a>
                        </li>

                        <li data-toggle="tooltip" data-placement="right" title="Kecamatan" style="position: relative;">
                            <a href="{{ route('admin.listkecamatan') }}">
                                <i class="fas fa-building" style="font-size:20px"></i>
                            </a>
                        </li>

                        <li data-toggle="tooltip" data-placement="right" title="Jenjang Pendidikan" style="position: relative;">
                            <a href="{{ route('admin.listjenjang') }}">
                                <i class="fas fa-graduation-cap" style="font-size:20px"></i>
                            </a>
                        </li>

                        <li data-toggle="tooltip" data-placement="right" title="Mata Pelajaran" style="position: relative;">
                            <a href="{{ route('admin.listmapel') }}">
                                <i class="fas fa-book" style="font-size:20px"></i>
                            </a>
                        </li>

                        <li data-toggle="tooltip" data-placement="right" title="Rekening" style="position: relative;">
                            <a href="{{ route('admin.rekening') }}">
                                <i class="fas fa-book" style="font-size:20px"></i>
                            </a>
                        </li>

                        {{--------------------------- DROPDOWN MENU ---------------------------}}
                        {{-- <li>
                            <div class="dropdown show">
                                <a class="dropdown-toggle menu-sidebar" href="#" role="button" id="configuration" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cogs"></i>
                                    <span id="span-short">Manage</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="configuration">
                                    <a href="{{ route('admin.listuser') }}">
                                        <i class="fas fa-user-cog"></i> <span>Users</span>
                                    </a>
                                    <a href="{{ route('admin.listprovinsi') }}">
                                        <i class="fas fa-map-marked-alt"></i> <span></span>
                                    </a>
                                    <a href="{{ route('admin.listkota') }}">
                                        <i class="fas fa-city"></i> <span>Kota / Kabupaten</span>
                                    </a>
                                    <a href="{{ route('admin.listorder') }}">
                                        <i class="fas fa-building"></i> <span>Kecamatan</span>
                                    </a>
                                     <a href="{{ route('admin.listjenjang') }}">
                                        <i class="fas fa-graduation-cap"></i><span>Jenjang Pendidikan</span>
                                    </a>
                                     <a href="{{ route('admin.listmapel') }}">
                                        <i class="fas fa-book"></i> <span>Mata Pelajaran</span>
                                    </a>
                                    <a href="{{ route('admin.rekening') }}">
                                        <i class="fas fa-book"></i> <span>Rekening</span>
                                    </a>
                                </div>
                                
                            </div>
                        </li> --}}
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Sidebar scroll-->
            <div class="sidebar-scroll" id="sidebar-scroll-2">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebar-navigation" class="in">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-chart-line"></i> <span id="span-long">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listorder') }}">
                                <i class="fas fa-archive"></i> <span>Order</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listtagihan') }}">
                                <i class="fas fa-money-bill-wave"></i> <span id="span-long">Data Tagihan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listtransaksi') }}">
                                <i class="fas fa-money-bill-wave"></i> <span id="span-long">Verifikasi Transfer</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.listguru') }}">
                                <i class="fas fa-users"></i> <span id="span-long">Verifikasi Profil Guru</span>
                            </a>
                        </li>

                         <li >
                            <a href="{{ route('admin.pengaduan') }}">
                               <i class="fa fa-volume-up" style="font-size:20px"></i><span id="span-long">Pengaduan</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.listuser') }}">
                                <i class="fas fa-user-cog"></i> <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listprovinsi') }}">
                                <i class="fas fa-map-marked-alt"></i> <span>Provinsi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listkota') }}">
                                <i class="fas fa-city"></i> <span>Kota</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listkecamatan') }}">
                                <i class="fas fa-building"></i> <span>Kecamatan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listjenjang') }}">
                                <i class="fas fa-graduation-cap"></i><span> Jenjang Pendidikan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listmapel') }}">
                                <i class="fas fa-book"></i> <span>Mata Pelajaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.rekening') }}">
                                <i class="fas fa-book"></i> <span>Rekening</span>
                            </a>
                        </li>

                        {{-------------------------------- DROPDOWN --------------------------------}}
                        {{-- <li>
                            <a data-toggle="collapse" id="toggle-sidebar" href="#configurationsCollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-cogs"></i> <span id="span-long">Manage</span>
                            </a>
                        </li>
                        <div class="collapse" id="configurationsCollapse">
                            <li>
                                <a href="{{ route('admin.listuser') }}">
                                    <i class="fas fa-user-cog"></i> <span>Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.listprovinsi') }}">
                                    <i class="fas fa-map-marked-alt"></i> <span>Provinsi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.listkota') }}">
                                    <i class="fas fa-city"></i> <span>Kota</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.listkecamatan') }}">
                                    <i class="fas fa-building"></i> <span>Kecamatan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.listjenjang') }}">
                                   <i class="fas fa-graduation-cap"></i><span> Jenjang Pendidikan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.listmapel') }}">
                                    <i class="fas fa-book"></i> <span>Mata Pelajaran</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.rekening') }}">
                                    <i class="fas fa-book"></i> <span>Rekening</span>
                                </a>
                            </li>
                        </div> --}}
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
        <!-- End Sidebar scroll-->
    </aside>