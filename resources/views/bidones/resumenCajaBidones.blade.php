
<!DOCTYPE html>
<html lang="en">

<head>
  @include('includes.head')
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- inicio header (barra de usuario y menu) -->
            @include('includes.header')
        <!-- FIN header (barra de usuario y menu) -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Resumen caja bidones</h1>
                    </div>

                    <div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Bidones entregados</h6>
                            </div>
                            @include('bidones.modales')


                            <div class="card-body">
                                <div class="container my-lg">
                                    <div>
                                   <!-- Button trigger modal -->
                                   <div class="form-row">
                                    <div class="col">
                                        <button type="button" class="btn btn-dark" style="background-color: #4E73DF;" onclick="filtrar();">Filtrar
                                        </button>
                                    </div>
                             
                                @if ( session('mensaje') )
                                <br>
                                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                                @endif
                                    </div>
                                    <div id="filtrar" style="display: none;">
                                        <br> <br>
                                        <div class="form-row">
                                            <div class="col">
                                                <form id="devo" action="{{ route('bidones.caja.filtrar') }}" method="POST">
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
                                        <br>
                                      
                                        @if ($message = Session::get('success'))
                                        <div class="alert alert-warning alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif
                                        <br>
                                        <h2 class="m-0 font-weight-bold text-primary" id="title">Resumen caja Bidones
                                            <a class="section-link" href="#examples"></a>
                                            <span class="border-bottom"></span></h2>
                                        <br>
                                            <table id="tablaResumen" class="table table-striped" style="width:100%; text-align: center;">
                                                <thead>
                                                    <tr>
                                                        <th>Distribuidor / Cliente</th>
                                                        <th>Bidones 10L</th>
                                                        <th>Bidones 20L</th>
                                                        <th>Fecha</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bidones as $bi)
                                                    <tr>
                                                        @if($bi->distribuidores()->exists())                     
                                                        <td>
                                                            <h5><span class="badge badge-secondary">{{$bi->distribuidores->distribuidor_local}}</span></h5>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <h5><span class="badge badge-primary">{{$bi->nombre}}</span></h5>
                                                        </td>
                                                    @endif
                                                        <td>
                                                            @if (isset($bi->bidon10))
                                                                {{$bi->bidon10}}
                                                            @else
                                                                0
                                                            @endif
                                                        <td>
                                                            @if (isset($bi->bidon20))
                                                            {{$bi->bidon20}}
                                                            @else
                                                                0
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $fecha= $bi->created_at->format('Y-m-d');
                                                                echo $fecha;
                                                            @endphp
                                                        </td>
                                                            @php
                                                              
                                                            @endphp
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <br> <br>
                                            <table class="table table-bordered table-primary">
                                                <thead style="text-align: center;">
                                                  <tr>
                                                    <th scope="col" colspan="2">Bidones disponibles</th>
                                                    <th scope="col" colspan="2">Bidones sin devolver</th>
                                                  </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
                                                  <tr>
                                                    <th>Bidon (10L)</th>
                                                    <td>
                                                        @php
                                                        foreach($producto as $pro){
                                                            if($pro->id == 1){
                                                                echo $pro->cantidad;
                                                            }
                                                        }
                                                        @endphp

                                                    </td>
                                                    <th>Bidon (10L)</th>
                                                    <td>{{ $bidones->sum('bidon10') }}</td>
                                                  </tr>
                                                  <tr>
                                                    <th>Bidon (20L)</th>
                                                    <td>
                                                        @php
                                                        foreach($producto as $pro){
                                                            if($pro->id == 2){
                                                                echo $pro->cantidad;
                                                            }
                                                        }
                                                        @endphp
                                                    </td>
                                                    <th>Bidon (20L)</th>
                                                    <td>{{ $bidones->sum('bidon20') }}</td>
                                                  </tr>
                                                
                                                </tbody>
                                              </table>
                                          
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
            <!-- End of Footer ---->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <!--SCRIPTS-->
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
            $('#tablaResumen').DataTable({
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrando _MENU_ bidones por página.",
                    "zeroRecords": "Upss! Parece que para hoy, no hay ningun bidon encargado.",
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