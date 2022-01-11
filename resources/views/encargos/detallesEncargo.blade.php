<!DOCTYPE html>
<html lang="en">

<head>
  @include('includes.head')
</head>
<style>
    :root {
  --body-bg-color: #1a1c1d;
  --text-color: #aaaebc;
  --hr-color: #26292a;
  --red: #e74c3c;
}

ul {
  list-style: none;
}

a {
  color: inherit;
  text-decoration: none;
}


hr {
  border-color: var(--hr-color);
  margin: 20px 0;
}

.menu {
  display: flex;
  justify-content: center;
}

.menu li {
  margin-right: 70px;
}

.menu a {
  position: relative;
  display: block;
  overflow: hidden;
}

.menu a span {
  transition: transform 0.2s ease-out;
}

.menu a span:first-child {
  display: inline-block;
  padding: 10px;
}

.menu a span:last-child {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  transform: translateY(-100%);
}

.menu i {
  font-size: 30px;
}

.menu a:hover span:first-child {
  transform: translateY(100%);
}

.menu a:hover span:last-child,
.menu[data-animation] a:hover span:last-child {
  transform: none;
}

/* ANIMATIONS
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.menu[data-animation="to-top"] a span:last-child {
  transform: translateY(100%);
}

.menu[data-animation="to-top"] a:hover span:first-child {
  transform: translateY(-100%);
}

.menu[data-animation="to-right"] a span:last-child {
  transform: translateX(-100%);
}

.menu[data-animation="to-right"] a:hover span:first-child {
  transform: translateX(100%);
}

.menu[data-animation="to-left"] a span:last-child {
  transform: translateX(100%);
}

.menu[data-animation="to-left"] a:hover span:first-child {
  transform: translateX(-100%);
}

/* FOOTER
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.page-footer {
  position: absolute;
  bottom: 10px;
  right: 10px;
  font-size: 1rem;
}

.page-footer span {
  color: var(--red);
}
</style>

<body id="page-top">
    <div id="wrapper">

        <!-- inicio header (barra de usuario y menu) -->
            @include('includes.header')
        <!-- FIN header (barra de usuario y menu) -->

               {{-- Contenido de la pagina  --}}
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <ul class="menu">
                        <li>
                          <a >
                            <span align="center">
                                <strong>Encargo:</strong><br>
                                <u style="color:#4B70DC;">{!! $encargos->nombre !!}</u>
                                </span>
                            <span>
                              <i class="fas fa-box-open"></i>
                            </span>
                          </a>
                        </li>
                        @if(!$encargos->distribuidor()->exists())
                        <li>
                            <a>
                              <span align="center">
                                  <strong>Distribuidor:</strong><br>
                                  <u style="color:#4B70DC;">Piren Co</u>
                                  </span>
                              <span>
                                <i class="fas fa-shipping-fast"></i>
                              </span> 
                            </a>
                          </li>
                          @else
                          <li>
                            <a >
                              <span align="center">
                                  <strong>Distribuidor:</strong><br>
                                  <u style="color:#4B70DC;">{!! $encargos->distribuidor->distribuidor_local !!}</u>
                                  </span>
                              <span>
                                <i class="fas fa-shipping-fast"></i>
                              </span> 
                            </a>
                          </li>
                          @endif
                          <li>
                            <a >
                              <span align="center">
                                  <strong>Domicilio:</strong><br>
                                  <u style="color:#4B70DC;">{!! $encargos->domicilio !!}</u>
                                  </span>
                              <span>
                                <i class="fas fa-map-marked-alt"></i>
                              </span>
                            </a>
                          </li><li>
                            <a >
                              <span align="center">
                                  <strong>Telefono:</strong><br>
                                  <u style="color:#4B70DC;">{!! $encargos->telefono !!}</u>
                                  </span>
                              <span>
                                <i class="fas fa-phone-alt"></i>
                              </span>
                            </a>
                          </li><li>
                            <a >
                              <span align="center">
                                  <strong>Fecha inicio:</strong><br>
                                  <u style="color:#4B70DC;">{!! $encargos->horario_de !!}</u>
                                  </span>
                              <span>
                                <i class="fas fa-calendar-day"></i>
                              </span>
                            </a>
                          </li>
                          <li>
                            <a >
                              <span align="center">
                                  <strong>Fecha fin:</strong><br>
                                  <u style="color:#4B70DC;">{!! $encargos->horario_hasta !!}</u>
                                  </span>
                              <span>
                                <i class="fas fa-calendar-week"></i>
                              </span>
                            </a>
                          </li>
                      </ul>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Encargo</h6>
                            <div class="cho-container"></div>
                        </div>
                        <div class="card-body">
                            <table  class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Tipo</th>
                                        <th>Cantidad</th>
                                        <th>Precio unitario</th>
                                        <th>Precio total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($encargos->detalles as $de)
                                        <tr>
                                            <td>{{ $de->producto->producto_botella }}</td>
                                            <td>{{ $de->producto->producto_descartable }}</td>
                                            <td>{{ $de->cantidad }}</td>
                                            <td>{{ $de->producto->producto_precio }}</td>
                                            <td>
                                                @php
                                                    echo $de->producto->producto_precio * $de->cantidad;
                                                @endphp
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between">
                                <div>
                                 <h5 style="color:#E64738;">Total:</h5>
                                </div>
                                <div>
                                    @foreach ($encargos->detalles as $de)
                                    @php
                                        $precios[] = intval($de->producto->producto_precio) * intval($de->cantidad);
                                       
                                    @endphp
                                    @endforeach
                                    @php
                                    $total = array_sum((array) $precios);
                                        echo '<p style="color:#E64738;">'.'$'.$total.'</p> ';
                                    @endphp
                                </td>
                                   </h5>
                                </div>
                           </div>
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
