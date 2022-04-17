<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('images/favicon.png')}}" alt="Hotel Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Hotel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">
                <img src="{{ asset('assets/admin/dist/img/user.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->username }}</a>
            </div>

        </div>
    
        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">

            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
            
        </div> --}}
    
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                {{-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link @if (Route::is('admin.dashboard')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        
                    </ul>


                </li> --}}

                <li class="nav-item">

                    <a href="{{ route('admin.dashboard.index') }}" class="nav-link @if (Route::is('admin.dashboard.index')) active @endif">
                        <i class="nav-icon fas fa-tv"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>

                <li class="nav-item">

                    <a href="{{ route('admin.kamar.index') }}" class="nav-link @if (Route::is('admin.kamar.index')) active @endif">
                        <i class="nav-icon fas fa-bed"></i>
                        <p>
                            Kamar
                        </p>
                    </a>

                </li>

                <li class="nav-item">

                    <a href="{{ route('admin.fasilitas.index') }}" class="nav-link @if (Route::is('admin.fasilitas.index')) active @endif">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Fasilitas Kamar
                        </p>
                    </a>

                </li>

                <li class="nav-item">

                    <a href="{{ route('admin.reservasi.index') }}" class="nav-link @if (Route::is('admin.reservasi.index')) active @endif">
                        <i class="nav-icon fas fa-pencil-alt"></i>
                        <p>
                            Reservasi
                        </p>
                    </a>

                </li>

                <li class="nav-item">

                    <a href="{{ route('admin.daftarTamu.index') }}" class="nav-link @if (Route::is('admin.daftarTamu.index')) active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Daftar Tamu
                        </p>
                    </a>

                </li>
                

                {{-- <li class="nav-item">

                    <a href="{{ route('admin.checkin.index') }}" class="nav-link @if (Route::is('admin.checkin.index')) active @endif">
                        <i class="nav-icon fas fa-check"></i>
                        <p>
                            Check In
                        </p>
                    </a>

                </li> --}}

                <li class="nav-item">

                    <a href="{{ route('admin.riwayat.index') }}" class="nav-link @if (Route::is('admin.riwayat.index')) active @endif">
                        <i class="nav-icon fas fa-history"></i>
                        <p>
                            Riwayat
                        </p>
                    </a>

                </li>

                <li class="nav-item">

                    <a href="{{ route('admin.gallery.index') }}" class="nav-link @if (Route::is('admin.gallery.index')) active @endif">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>

                </li>

                <li class="nav-item">

                    <a href="{{ route('admin.contact.index') }}" class="nav-link @if (Route::is('admin.contact.index')) active @endif">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                            Contact Message
                        </p>
                    </a>

                </li>

                

                <li class="nav-item">

                    <a href="{{ route('admin.laporanKeuangan.index', ['between' => 'all']) }}" class="nav-link @if (Route::is('admin.laporanKeuangan.index')) active @endif">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Laporan Keuangan
                        </p>
                    </a>

                </li>


                
                <li class="nav-item">

                    <a href="{{ route('admin.UsersAdmin.index') }}" class="nav-link @if (Route::is('admin.UsersAdmin.index')) active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users Admin
                        </p>
                    </a>

                </li>

                
            </ul>
        </nav>
        
    
    </div>
    <!-- /.sidebar -->

</aside>

