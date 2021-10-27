<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('libs/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href=" https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
   
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">



    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    


    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>

</head>

<body id="page-top">



    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
                <img src="/images/logo.png" height="75">
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
                <a class="nav-link" href="{{ url('/pedidos') }}">
                    <i class="fas fa-fw fa-dolly"></i>
                    <span>Pedidos</span></a>
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
                <a class="nav-link" href="{{ url('/resumenmonthly') }}">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>Resumen Caja</span></a>
            </li>
            <div class="sidebar-heading">
                Cajas Bidones
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/botellas') }}">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>Caja Bidones</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/resumenbotellas') }}">
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Pedidos</h1>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de pedidos</h6>
                            <div class="cho-container"></div>
                        </div>
                        <div class="card-body">
                            <table id="tblPedidos" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Detalle</th>
                                        <th>Monto</th>
                                        <th>Pago</th>
                                        <th>Distribuidora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedidos as $pedido)
                            
                            
                                        <tr>
                                            <td>{{ $pedido->pedido_detalle }}</td>
                                            <td>{{ $pedido->pedido_monto }}</td>
                                            <td>{{ $pedido->pedido_pago }}</td>
                                            <td>{{ $pedido->pedido_distribuidora }}</td>
                                        </tr>
                            
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>







                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PirenCo 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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

    <script>
        $(document).ready(function() {
            $('#tblPedidos').DataTable({
                "language": {
                    "search": "Buscar pedido:",
                    "lengthMenu": "Mostrando _MENU_ pedidos por página.",
                    "zeroRecords": "Upss! Parece que aun no hay ningun pedido agregado.",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "Sin pedidos añadidos.",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    }
                }
            });
        });
    </script>


    <!--SCRIPTS-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
