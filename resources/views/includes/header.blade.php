<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}"> <br>
        <img src="{{asset('images/logoG.png')}}" height="75" width="100%">
      </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
      <br>
    <!-- Heading -->
    <div class="sidebar-heading">
        Servicios
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/distribuidores')}}">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>Distribuidores</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/productos') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Productos</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('encargos') }}">
            <i class="fas fa-fw fa-dolly"></i>
            <span>Encargos</span></a>
    </li>
    <div class="sidebar-heading">
        Cajas
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/caja') }}">
            <i class="fas fa-fw fa-cash-register"></i>
            <span>Caja</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('resumen.caja') }}">
            <i class="fas fa-fw fa-cash-register"></i>
            <span>Resumen Caja</span></a>
    </li>
    <div class="sidebar-heading">
        Cajas Bidones
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('bidones.caja') }}">
            <i class="fas fa-fw fa-cash-register"></i>
            <span>Caja Bidones</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('bidonesG.resumen') }}">
            <i class="fas fa-fw fa-cash-register"></i>
            <span>Resumen Caja Bidones</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span
                            class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                        <img class="img-profile rounded-circle"
                            src="https://www.emmegi.co.uk/wp-content/uploads/2019/01/User-Icon.jpg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"
                            href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Salir
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
          <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estas seguro de cerrar sesion?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Seleccionar "Cerrar Sesion" debajo si estas seguro de cerrar sesion.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" href="{{ url('/logout') }}">Cerrar
                        Sesion</button>
                </form>
            </div>
        </div>
    </div>
</div>