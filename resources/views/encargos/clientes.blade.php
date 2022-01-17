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

               {{-- Contenido de la pagina  --}}
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Encargos</h1>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de encargos</h6>
                            <div class="cho-container"></div>
                        </div>
                        <div class="card-body">
                            <table id="tblPedidos" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Pedido</th>
                                        <th>Domicilio</th>
                                        <th>Cantidad productos</th>
                                        <th>Total</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($encargos as $encargo)
                                        <tr>
                                            <td>{!! $encargo->nombre !!}</td>
                                            <td>{!! $encargo->domicilio !!}</td>
                                            <td>
                                                {{ $encargo->detalles->sum('cantidad') }}
                                            </td>
                                            <td>
                                                {{ $encargo->detalles->sum('sub_total') }}
                                            </td>
                                            <td>
                                                <a href="{{route('detalles.encargo', $encargo )}}"><i class="fas fa-search"></i> Ver</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            {{-- FIN Contenido de la pagina  --}}

@include('includes.footer')
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
