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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet"
        type="text/css">
    <link href=" https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
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
            @include('includes.header')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Resumen Bidones</h1>
                    </div>

                    <div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Resumen Bidones</h6>
                            </div>
                            <div class="card-body">
                                <div class="container my-lg">
                                        <table class="table" border="1">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <form  action="{{ route('bidones.dia') }}" method="POST">
                                                            @csrf
                                                            <label>Seleccione el dia que desea filtrar: <hr>
                                                                Día:  <input type="date" name="fecha" style="border-radius: 5px;" id="fecha"> 
                                                            </label>
                                                            <button type="submit" class="btn btn-success" name="filtrar" id="filtrar" >Filtrar</button> 
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <form action="{{ route('bidones.dia') }}" method="POST">
                                                            @csrf
                                                            <label>Seleccione el mes que desea filtrar: <hr>
                                                                Mes: <input type="month" name="mes" style="border-radius: 5px;" id="fecha"> 
                                                                
                                                            </label>
                                                            <button type="submit" class="btn btn-success" name="filtrar" id="filtrar" >Filtrar</button> 
                                                        </form>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table id="tablaCaja">
                                        <br>
                                        <h2 class="m-0 font-weight-bold text-primary" id="title">Resumen Bidones
                                            <a class="section-link" href="#examples"></a>
                                            <span class="border-bottom"></span></h2>
                                        <br>
                                            <table id="tblPedidos" class="table table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">Cantidad encargos</th>
                                                        <th style="text-align: center;">Bidones 10L</th>
                                                        <th style="text-align: center;">Bidones 20L</th>
                                                        @if(isset($mes))
                                                            <th style="text-align: center;">Mes</th>
                                                        @else
                                                            <th style="text-align: center;">Fecha</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                @if(!sizeof($bidones) == 0)
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center; ">{{$encargos}} </td>
                                                        <td style="text-align: center;">{{ $bidones->sum('bidon20') }} </td>
                                                        <td style="text-align: center;">{{ $bidones->sum('bidon10') }}</td>
                                                        <td style="text-align: center;">
                                                        @if(isset($mes))
                                                            {{$mes}}
                                                        @else
                                                            @foreach ($bidones as $bi)
                                                                @php
                                                                $fecha= $bi->created_at->format('Y-m-d');
                                                                @endphp
                                                            @endforeach
                                                        
                                                         @php
                                                             echo $fecha;
                                                         @endphp
                                                    @endif    
                                                </tbody>
                                                @else
                                                    <tr>
                                                     <div class="alert alert-warning" role="alert">
                                                         <strong>¡No hay encargos de bidones para esta fecha!</strong>
                                                     </div>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                </div>
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
    <!--SCRIPTS-->
    <script>
        $(document).ready(function() {
            $('#tablaCaja').DataTable({
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
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/resumenBidones.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"
        integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css"
        integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</body>

</html>
