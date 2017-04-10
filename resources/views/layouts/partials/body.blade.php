<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">
                <div align="center" class="navbar nav_title" style="border: 0;background-color: #fff">
                    <a href="/home"><img style="max-width: 100%; height: 100%;" src="/img/siemens-logo2.fw.png" class="img-responsive"></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_info">
                        <span>Bienvenido,</span>
                        <h2>{{ Auth::user()->name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            @if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()) || Gate::allows('client', Auth::user()))
                            <li><a><i class="fa fa-wrench"></i> Panel de Administración <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="/clients">Clientes</a></li>
                                    @if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
                                    <li><a href="/plants">Sedes</a></li>
                                    <li><a href="/equipments">Equipos</a></li>
                                    @endif
                                    <li><a href="/users">Usuarios</a></li>
                                    <li><a href="/user-access">Acceso Usuario</a></li>
                                </ul>
                            </li>
                            
                             <li><a><i class="fa fa-edit"></i> Panel de Usuario <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="/clients">Clientes</a></li>
                                </ul>
                            </li>
                            @endif
                            <li><a><i class="fa fa-edit"></i> Monitor <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="/monitor">Monitor</a></li>
                                    <li><a href="/reports">Reportes</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-envelope"></i> Email Contacto <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="mailto:raul.torres_zarate@siemens.com?Subject=Soporte DriveSysMonitor" target="_blank">Raul Torres</a></li>
                                    <li><a href="mailto:alberto.cruz@siemens.com?Subject=Soporte DriveSysMonitor" target="_blank">Alberto Cruz</a></li>
                                    </li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-phone"></i> Teléfonos Contacto <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a>+57 310 309 00 77</a></li>
                                    <li><a>+57 320 469 93 75</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    
                    <div class="nav toggle">
                        <p style="font-size: 22px">DriveSysMonitor</p>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="/home">Home</a></li>
                                <li><a href="/user_profile"><i class="fa fa-user pull-right"></i>Perfil</a></li>
                                <li>
                                    <a href="#" onclick="document.getElementById('logout-form').submit();">
                                        <form id="logout-form" action="{{ url('/../logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                        <i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        @yield('content')
        @include('layouts.partials.footer')
    </div>
</div>