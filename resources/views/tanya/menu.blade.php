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
                        <li data-toggle="tooltip" data-placement="right" title="Dashboard" @if(Route::currentRouteName()=="tanya.dashboard") style="background-color: orange;" @endif>
                            <a href="{{ route('tanya.dashboard') }}">
                                <i class="fas fa-chart-line" @if(Route::currentRouteName()=="tanya.dashboard") style="color: white;" @endif></i>
                            </a>
                        </li>

                        <li data-toggle="tooltip" data-placement="right" title="Diskusi"  @if(Route::currentRouteName()=="tanya.pertanyaan" or Route::currentRouteName()=="tanya.detail") style="background-color: orange;" @endif>
                            <a href="{{ route('tanya.pertanyaan') }}">
                                <i class="fas fa-comments" @if(Route::currentRouteName()=="tanya.pertanyaan" or Route::currentRouteName()=="tanya.detail") style="color: white;" @endif></i>
                            </a>
                        </li>


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
                        <li @if(Route::currentRouteName()=="tanya.dashboard") style="background-color: orange;" @endif>
                            <a href="{{ route('tanya.dashboard') }}">
                                <i class="fas fa-chart-line" @if(Route::currentRouteName()=="tanya.dashboard") style="color: white" 
                                @endif>
                                    
                                </i> <span id="span-long" @if(Route::currentRouteName()=="tanya.dashboard") style="color: white" 
                                @endif>Dashboard</span>
                            </a>
                        </li>

                        <li @if(Route::currentRouteName()=="tanya.pertanyaan" or Route::currentRouteName()=="tanya.detail") style="background-color: orange;" @endif>
                            <a href="{{ route('tanya.pertanyaan') }}">
                                <i class="fas fa-comments" @if(Route::currentRouteName()=="tanya.pertanyaan" or Route::currentRouteName()=="tanya.detail") style="color: white" @endif>
                                </i>
                                <span id="span-long" @if(Route::currentRouteName()=="tanya.pertanyaan" or Route::currentRouteName()=="tanya.detail")
                                style="color: white" @endif>Pertanyaan</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
        <!-- End Sidebar scroll-->
    </aside>