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
                <a class="nav-link" href="{{ url('/distribuidores') }}">
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
                        <h1 class="h3 mb-0 text-gray-800">Resumen Mensual</h1>
                    </div>

                    <div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Resumen Mensual</h6>
                            </div>
                            <div class="card-body">
                                <form></form>
                                <div class="container my-lg">
                                    <h2 class="m-0 font-weight-bold text-primary" id="title">Resumen Mensual<a
                                            class="section-link" href="#examples"></a><span
                                            class="border-bottom"></span></h2>
                                    <div class="doc-example">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form>
                                                    <script type="text/javascript">
                                                        function resumenRender() {
                                                            let url = "{{ route('resumenmonthly.render', ['day' => 22222]) }}".replace('22222', $('#fecha').val());
                                                            window.location.href = url;
                                                        }

                                                        function modalFacturar(id, date) {
                                                            var fecha = prompt("Fecha de Factura DD/MM/AAAA");
                                                            var numero = prompt("Tipo y Numero de Factura, ej: A 1001-000040");
                                                            var monto = prompt("Monto SIN decimales, ni simbolos, ejemplo: 50000 para $50.000");

                                                            $.ajax({
                                                                url: '{{ route('resumenmonthly.create') }}',
                                                                type: 'GET',
                                                                data: {
                                                                    date: date,
                                                                    id: id,
                                                                    fecha: fecha,
                                                                    numero: numero,
                                                                    monto: monto
                                                                },
                                                                success: function(result) {
                                                                    if (result === '1') {
                                                                        alert('Creado exitosamente.');
                                                                        location.reload();
                                                                    }
                                                                }
                                                            });

                                                        }
                                                    </script>

                                                    <div id="selectoption" class="form-group">
                                                        <label for="exampleFormControlInput1">Seleccione un Mes</label>
                                                        <br>
                                                        <i style="color: red;">Importante: El día no será
                                                            considerado.</i>
                                                        <input onchange="resumenRender()" id="fecha"
                                                            class="form-control datepicker1" type="text"
                                                            value="@php
                                                                if (isset($day)):
                                                                    echo $day;
                                                                else:
                                                                    echo date('Y-m-d');
                                                                endif;
                                                            @endphp" placeholder="Mes">
                                                    </div>
                                                    <!-- Remitos management -->

                                                    @if (isset($day))
                                                        <table class="table borderless table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" class="text"
                                                                        style="font-weight: bold; background: lightgray;">
                                                                        Empresa</th>
                                                                    <th scope="col" class="text"
                                                                        style="font-weight: bold; background: lightgray;">
                                                                        Total</th>
                                                                    <th scope="col" class="text"
                                                                        style="font-weight: bold; background: lightgray;">
                                                                        Remitos</th>
                                                                    <th scope="col" class="text"
                                                                        style="font-weight: bold; background: lightgray;">
                                                                        Facturar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="table">
                                                                @php $totalGeneral = 0; @endphp
                                                                @foreach ($salesByClient as $id => $sale)
                                                                    <tr>
                                                                        <td>{{ $sale['Name'] }}</td>
                                                                        <td>
                                                                            ${{ $sale['Total'] }}
                                                                            @php $totalGeneral += $sale["Total"]; @endphp
                                                                        </td>
                                                                        <td>{{ $sale['Remtios'] }}</td>
                                                                        <td>
                                                                            @if ($sale['Billed'] > 0)
                                                                                <p
                                                                                    style="color: green; font-weight: bold;">
                                                                                    Ya fué facturado.</p>
                                                                            @else
                                                                                <button
                                                                                    onclick="modalFacturar('{{ $id }}', '{{ $day }}')"
                                                                                    type="button"
                                                                                    class="btn btn-primary"
                                                                                    onclick="$">Facturar</button>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th scope="col" class="text"
                                                                        style="font-weight: 500;"></th>
                                                                    <th scope="col" class="text"
                                                                        style="font-weight: 500; color: red;">Total Cta
                                                                        Cte: ${{ $totalGeneral }}</th>
                                                                    <th></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        <script type="text/javascript">
                                                            /* API REST */
                                                            function delete_row(id) {
                                                                $.ajax({
                                                                    url: '{{ route('remitos.destroy', 1) }}'.replace('1', id),
                                                                    type: 'DELETE',
                                                                    success: function(result) {
                                                                        alert('Borrado exitosamente.');
                                                                        location.reload();
                                                                    }
                                                                });
                                                            }
                                                        </script>

                                                    @endif

                                                    <script>
                                                        $(function() {
                                                            $(".datepicker1").datepicker({
                                                                format: 'yyyy-mm-dd'
                                                            });
                                                            $(".datepicker2").datepicker({
                                                                format: 'dd/mm/yyyy'
                                                            });
                                                        });
                                                    </script>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function create_row_recibo(id) {
                                        var fecha = prompt("Fecha de Pago DD/MM/AAAA");
                                        var numero = prompt("Numero de Recibo, ej: 000040");
                                        var monto = prompt("Monto SIN decimales, ni simbolos, ejemplo: 50000 para $50.000");

                                        $.ajax({
                                            url: '{{ route('resumenmonthly.addrecibo') }}',
                                            type: 'GET',
                                            data: {
                                                id: id,
                                                fecha: fecha,
                                                numero: numero,
                                                monto: monto
                                            },
                                            success: function(result) {
                                                if (result === '1') {
                                                    alert('Creado exitosamente.');
                                                    location.reload();
                                                }
                                            }
                                        });
                                    }
                                </script>

                                <div class="container my-lg">
                                    <h2 class="m-0 font-weight-bold text-primary" id="title">Cuentas Corrientes<a
                                            class="section-link" href="#examples"></a><span
                                            class="border-bottom"></span></h2>
                                            <br>
                                    <div class="doc-example">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @foreach ($cc as $id => $data)
                                                    <h4 class="m-0 font-weight-bold text-primary">{{ $id }} <button
                                                            style="float: right; margin-right: 10px; margin-bottom: 10px !important;"
                                                            id="create" type="button" class="btn btn-primary"
                                                            onclick="create_row_recibo('{{ $data['id'] }}');">Dar de
                                                            Alta Pago<div class="ripple-container"></div></button></h4>
                                                    <table class="table borderless table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="text"
                                                                    style="font-weight: bold; background: lightgray;">
                                                                    Fecha</th>
                                                                <th scope="col" class="text"
                                                                    style="font-weight: bold; background: lightgray;">
                                                                    Concepto</th>
                                                                <th scope="col" class="text"
                                                                    style="font-weight: bold; background: lightgray;">
                                                                    Debe</th>
                                                                <th scope="col" class="text"
                                                                    style="font-weight: bold; background: lightgray;">
                                                                    Haber</th>
                                                                <th scope="col" class="text"
                                                                    style="font-weight: bold; background: lightgray;">
                                                                    Saldo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table">
                                                            @php $ccBalance = 0; @endphp
                                                            @foreach ($data['movements'] as $dataRow)
                                                                <tr>
                                                                    <td>{{ $dataRow->date }}</td>


                                                                    @php
                                                                        if ($dataRow->type == 'debe'):
                                                                            $ccBalance += $dataRow->ammount;
                                                                            echo '<td>' . $dataRow->concept . '</td>';
                                                                            echo '<td>$ ' . $dataRow->ammount . '</td>';
                                                                            echo '<td></td>';
                                                                        else:
                                                                            $ccBalance -= $dataRow->ammount;
                                                                            echo '<td>Pago Recibo ' . $dataRow->concept . '</td>';
                                                                            echo '<td></td>';
                                                                            echo '<td>($ ' . $dataRow->ammount . ')</td>';
                                                                        endif;
                                                                    @endphp

                                                                    <td>$ {{ $ccBalance }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
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
        $(function() {
            $('#saveProducto').on('submit', function(e) {
                e.preventDefault();

                var saveProducto = this;
                $.ajax({
                    url: $(saveProducto).attr('action'),
                    method: $(saveProducto).attr('method'),
                    data: new FormData(saveProducto),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(saveProducto).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.code == 0) {
                            $.each(data.error, function(prefix, val) {
                                $(saveProducto).find('span.' + prefix + '_error')
                                    .text(val[0]);
                                console.log(data.error);
                            });
                        } else {
                            $(saveProducto)[0].reset();
                            fetchAllProductos();
                        }
                    }
                });
            });

            //Fetch all products
            fetchAllProductos();

            function fetchAllProductos() {
                $.get('{{ route('fetch.productos') }}', {}, function(data) {
                    $('#allProductos').html(data.result);
                }, 'json');
            }

            //Funcion Boton Editar Producto
            $(document).on('click', '#editarBtn', function() {
                var producto_id = $(this).data('id');
                var url = '{{ route('get.productos.details') }}';
                $.get(url, {
                    producto_id: producto_id
                }, function(data) {

                    var producto_modal = $('.editProductoModal');

                    $(producto_modal).find('form').find('input[name="pid"]').val(data.result.id);
                    $(producto_modal).find('form').find('input[name="producto_botella"]').val(data
                        .result.producto_botella);
                    $(producto_modal).find('form').find('input[name="producto_descartable"]').val(
                        data.result.producto_descartable);
                    $(producto_modal).find('form').find('input[name="producto_litros"]').val(data
                        .result.producto_litros);
                    $(producto_modal).find('form').find('input[name="producto_precio"]').val(data
                        .result.producto_precio);
                    $(producto_modal).find('form').find('span.error-text').text('');
                    $(producto_modal).modal('show');
                }, 'json');
            });

            //Update producto modal
            $('#update_form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.code == 0) {
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            alert(data.msg);
                            fetchAllProductos();
                            $('.editProductoModal').modal('hide');
                        }
                    }
                })
            });

            //Funcion boton eliminar producto

            $(document).on('click', '#eliminarBtn', function() {
                var producto_id = $(this).data('id');
                var url = '{{ route('delete.producto') }}';

                if (confirm('Estas seguro de eliminar este producto?')) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        method: 'POST',
                        data: {
                            producto_id: producto_id
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.code == 1) {
                                fetchAllProductos();
                            } else {
                                alert(data.msg);
                            }
                        }
                    });
                }

            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>


    <!--SCRIPTS-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"
        integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css"
        integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</body>

</html>
