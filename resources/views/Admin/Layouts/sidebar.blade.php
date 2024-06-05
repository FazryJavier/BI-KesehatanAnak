<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src={{ asset('adminlte/dist/img/AdminLTELogo.png') }} alt="Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Healthy Care</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header">HALAMAN</li>

                {{-- Landing Page --}}
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{-- End Landing Page --}}

                {{-- Content --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Content
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/KabarTerkini" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kabar Terkini</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/LookerStudio" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Looker Studio</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Content --}}

                {{-- Admin --}}
                <li class="nav-item">
                    <a href="/InfoAdmin" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>
                {{-- End Admin --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
