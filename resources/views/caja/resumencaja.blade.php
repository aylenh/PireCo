<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
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
                        <h1 class="h3 mb-0 text-gray-800">Resumen caja</h1>
                    </div>

                    <div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Resumen caja</h6>
                            </div>
                            <div class="card-body">
                                <div class="container my-lg">
                                    <div>
                                        {{-- <form action="{{ route('inventario.bidones') }} " method="POST" >
                                            @csrf 
                                            <label> <strong>Ingrese la cantidad de bidones que devolvieron:</strong> <hr>
                                            Bidones devueltos: <input type="number" style="border-radius: 5px;" width="20" name="devolucion">
                                            <button type="submit" class="btn btn-warning" id="devolucionBidones">Guardar</button>   
                                        </form> --}}
                                    </div>
                                    <button type="button" class="btn btn-dark" style="background-color: #4E73DF;" onclick="filtrar();">Filtrar
                                    </button>
                               
                                    <div id="filtrar" style="display: none;">
                                        <br> <br>
                                        <div class="form-row">
                                            <div class="col">
                                                <form id="devo" action="{{ route('resumencaja.filtro') }}" method="POST">
                                                    @csrf
                                                    <label> <strong>Seleccione el rango de fechas para filtrar:</strong><hr>
                                                        Desde:  <input type="date" name="fecha"style="border-radius: 5px;" id="fecha"> 
                                                        Hasta:  <input type="date" name="fecha2"style="border-radius: 5px;" id="fecha2">
                                                    </label>
                                                    <button type="submit" class="btn btn-success" name="filtrar" id="filtrar" >Filtrar</button> 
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                        @if ($message = Session::get('success'))
                                        <div class="alert alert-warning alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif
                                        <br>
                                        <br>
                                        
                                        <h2 class="m-0 font-weight-bold text-primary" id="title">Caja 
                                            <a class="section-link" href="#examples"></a>
                                            <span class="border-bottom"></span></h2>
                                        <br>

                                            <table id="tblCaja" class="table table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Distribuidor</th>
                                                        <th>Debe</th>
                                                        <th>Haber</th>
                                                        {{-- <th>Saldo</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($encargo as $en)
                                                            <tr>
                                                                <td>
                                                                    @if ($en)
                                                                        {{$en->created_at}}
                                                                    @else
                                                                        {{-- {{$egre->created_at}} --}}0
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($en->distribuidor()->exists())
                                                                        {{$en->distribuidor->distribuidor_local}}
                                                                    @else
                                                                        {{$en->nombre}}
                                                                    @endif
                                                                </td>
                                                                <td>${{$en->total}}</td>
                                                                <td></td>
                                                            </tr>
                                                            @endforeach
                                                            @foreach ($egreso as $egre)
                                                            <tr>
                                                                <td>{{$egre->created_at}}</td>
                                                                <td>{{$egre->cliente_distribuidor}}</td>
                                                                <td></td>
                                                                <td>${{$egre->monto}}</td>
                                                            </tr>
                                                            @endforeach
                                             
                                                </tbody>

                                            </table>
                                            <br>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h4 style="color:#E64738;">Total:</h4>
                                                </div>
                                                <div>
                                                    <h4 style="color:#1e7734;">
                                                        @php
                                                        $total = $encargo->sum('total') -$egreso->sum('monto');
                                                        echo "$"."$total";
                                                    @endphp
                                                    </h4>
                                                </div>
                                            </div>
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
    <script>
        function filtrar() {
        var x = document.getElementById("filtrar");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
    </script>
    <script>
        $(document).ready(function() {
            $('#tblCaja').DataTable({
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrando _MENU_ registros por página.",
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
    <!-- End of Page Wrapper -->
    <!--SCRIPTS-->
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
