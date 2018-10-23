            <nav id="sidebar">
                <!-- Sidebar Scroll Container -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Side Header -->
                        <div class="content-header content-header-fullrow px-15">
                            <!-- Mini Mode -->
                            <div class="content-header-section sidebar-mini-visible-b">
                                <!-- Logo -->
                                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                                </span>
                                <!-- END Logo -->
                            </div>
                            <!-- END Mini Mode -->

                            <!-- Normal Mode -->
                            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                                <!-- Close Sidebar, Visible only on mobile screens -->
                                <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                                <!-- END Close Sidebar -->

                                <!-- Logo -->
                                <div class="content-header-item">
                                    <a class="link-effect font-w700" href="">
                                        <i class="si si-drop"></i>
                                        <span class="font-size-xl text-dual-primary-dark">Gluco</span><span class="font-size-xl text-primary">Log</span>
                                    </a>
                                </div>
                                <!-- END Logo -->
                            </div>
                            <!-- END Normal Mode -->
                        </div>
                        <!-- END Side Header -->


                        <!-- Side Navigation -->
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <li>
                                    <a class="active" href="/home">
                                        <i class="si si-cup"></i>
                                        <span class="sidebar-mini-hide">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-main-heading">
                                    <span class="sidebar-mini-visible">HD</span>
                                    <span class="sidebar-mini-hidden">Heading</span>
                                </li>
                                @if (Auth::user()->isAdmin())
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                        <i class="si si-users"></i>
                                        <span class="sidebar-mini-hide">Admin</span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="/admin/create">Crear usuario</a>
                                        </li>
                                        <li>
                                            <a href="/admin">Usuarios</a>
                                        </li>
                                    </ul>
                                </li>
                               
                                @endif
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                        <i class="si si-drop"></i>
                                        <span class="sidebar-mini-hide">Nivel de Glicemia</span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="/records/create">Registrar nivel de glicemia</a>
                                        </li>
                                        <li>
                                            <a href="/records">Historial</a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                            <i class="si si-graph"></i>
                                            <span class="sidebar-mini-hide">Peso</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="/weights/create">Registrar Peso</a>
                                            </li>
                                            <li>
                                                <a href="/weights">Historial de peso</a>
                                            </li>
                                        </ul>
                                    </li>
                            </ul>
                        </div>
                        <!-- END Side Navigation -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>
            <!-- END Sidebar -->