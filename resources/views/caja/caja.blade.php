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

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

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

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

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

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy
                                            with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
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
                                    src="https://source.unsplash.com/Mv9hjnEUHR4/60x60">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
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
                        <h1 class="h3 mb-0 text-gray-800">Caja</h1>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Caja Interna</h6>
                        </div>
                        <div class="card-body">
                          <script>
                            function create_income() {
                                $.ajax({
                                      url: '{{route("cash.addincome")}}',
                                      type: 'GET',
                                      data: {
                                        concept:                 $('#ingreso_tipo option:selected').val(),
                                        ammount:                 $('#ingreso_cantidad').val(),
                                        ingreso_mercadopago:     $('#ingreso_mercadopago').val(),
                                        formadepagodigitalselector: $('#formadepagodigitalselector option:selected').val(),
                                        lastAmmount:             $('#lastAmmount').val(),
                                        ingresos_observaciones:    $('#ingresos_observaciones').val(),
                                        monto:                   $('#monto').val()
                                      },
                                      success: function(result) {
                                          if(result === '1'){
                                            alert('Guarado exitosamente.');
                                            location.reload();
                                          }
                                      }
                                  });
                              }
                    
                              function create_outcome() {
                                $.ajax({
                                      url: '{{route("cash.addoutcome")}}',
                                      type: 'GET',
                                      data: {
                                        concept:                 $('#egreso_tipo option:selected').val(),
                                        ammount:                 $('#egreso_monto').val(),
                                        egreso_observaciones:    $('#egreso_observaciones').val(),
                                        lastAmmount:             $('#lastAmmount').val()
                                      },
                                      success: function(result) {
                                          if(result === '1'){
                                            alert('Guarado exitosamente.');
                                            location.reload();
                                          }
                                      }
                                  });
                              }
                          </script>
                    
                          <div class="container my-lg">
                              <h2 class="doc-section-title" id="title">Caja Interna<a class="section-link" href="#examples"></a><span class="border-bottom"></span></h2>
                              <div class="doc-example">
                                  <div class="">
                    
                                      <script type="text/javascript">
                                        function resumenRender(date) 
                                        {
                                          let url = "{{ route('cash.render', ['day' => 22222]) }}".replace('22222', date);
                                              window.location.href = url;
                                        }
                    
                                        @php
                                          if(!isset($day)):
                                            $day = date('Y-m-d');
                                          endif;
                                        @endphp
                    
                                        function closeDay() 
                                        {
                                          var excedente = prompt("Aqueo: ¿Hay saldo a favor (excedente)? Especifique el monto, sin decimales, sin separador de miles y sin signo de $, caso contrario deje el campo vacio");
                                          if(excedente == "") 
                                          {
                                            var faltante = prompt("Aqueo: ¿Hay saldo en contra (faltante)? Especifique el monto, sin decimales, sin separador de miles y sin signo de $, caso contrario deje el campo vacio");
                                            if(faltante != "") 
                                            {
                                              /* Guardar faltante */
                                              $.ajax({
                                                url: '{{route("cash.addoutcome")}}',
                                                type: 'GET',
                                                data: {
                                                  day:                     '{{$day}}',
                                                  concept:                 'Cierre y Ajuste de Caja',
                                                  monto:                    faltante,
                                                  ammount:                  1,
                                                  ingreso_mercadopago:      '',
                                                  lastAmmount:             $('#lastAmmount').val()
                                                },
                                                success: function(result) {
                                                    if(result === '1'){
                                                      alert('Guarado exitosamente.');
                                                      location.reload();
                                                    }
                                                }
                                              });
                                            }else{
                                              /* Guardar SIN FALTANTES */
                                              $.ajax({
                                                url: '{{route("cash.addoutcome")}}',
                                                type: 'GET',
                                                data: {
                                                  day:                     '{{$day}}',
                                                  concept:                 'Cierre y Ajuste de Caja (Sin Faltantes)',
                                                  monto:                   0,
                                                  ammount:                1,
                                                  ingreso_mercadopago:     '',
                                                  lastAmmount:             $('#lastAmmount').val()
                                                },
                                                success: function(result) {
                                                    if(result === '1'){
                                                      alert('Guarado exitosamente.');
                                                      location.reload();
                                                    }
                                                }
                                              });
                                            }
                                          }else{
                                            /* Guardar excedente */
                                            $.ajax({
                                                url: '{{route("cash.addincome")}}',
                                                type: 'GET',
                                                data: {
                                                  day:                     '{{$day}}',
                                                  concept:                 'Cierre y Ajuste de Caja',
                                                  ammount:                 1,
                                                  monto:                    excedente,
                                                  ingreso_mercadopago:     '',
                                                  lastAmmount:             $('#lastAmmount').val()
                                                },
                                                success: function(result) {
                                                    if(result === '1'){
                                                      alert('Guarado exitosamente.');
                                                      location.reload();
                                                    }
                                                }
                                            });
                                          }
                                          
                                        }
                    
                                      </script>
                    
                                    @if(Auth::user()->profiletype == 1)
                                      <button style="height: fit-content; margin-top: 20px; margin-left: 20px;" type="button" class="btn btn-primary" onclick="resumenRender('{{date('Y-m-d')}}');">Hoy</button>
                                      <div id="selectoption" class="form-group" style="padding-left: 20px;">
                                          <label for="exampleFormControlInput1">Fecha</label>
                                          <input onchange="resumenRender($('#fecha').val())" id="fecha" class="form-control datepicker1" type="text" value="@php 
                                            if(isset($day)): echo $day; else: echo date('Y-m-d'); endif;
                                          @endphp" placeholder="Fecha">
                                      </div>
                                      @endif
                    
                                      @if(!$mainview)
                                    
                                          @if($day == date('Y-m-d'))
                                            <!-- Cargar un Ingreso -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ingreso">
                                              Cargar un Ingreso
                                            </button>
                                            <div class="modal fade" id="ingreso" tabindex="-1" role="dialog" aria-labelledby="ingresoLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document" style="top: 200px;">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="ingresoLabel">Cargar Ingreso</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                    
                                                    <script>
                                                      function fillPrice(servicio) {
                                                        /* alert(servicio); */
                                                        var dataService = servicio.split('- $');
                                                        $('#monto').val(dataService[1]);
                                                      }
                                                    </script>
                    
                                                    <div id="ingreso_tipo" class="form-group  bmd-form-group">
                                                        <label for="exampleFormControlInput1">Ingreso</label>
                                                        <select id="servicio" onchange="fillPrice($(this).val())" class="js-example-basic-single form-control" name="state">
                                                          <option value="">Ingreso</option>
                                                          @for ($i = 1; $i <= 20; $i++)
                                                              @php 
                                                                $serviceName = $incomes[0]->{'service' . $i}; 
                                                                $value = $incomes[0]->{'price' . $i}; 
                                                              @endphp
                                                                @if( $value != null )
                                                                  <option value="{{$serviceName}} - ${{$value}}">{{$serviceName}} - ${{$value}}</option>
                                                                @endif
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="form-group bmd-form-group">
                                                        <label for="exampleInputEmail1" class="bmd-label-static">Cantidad</label>
                                                        <input type="input" class="form-control" id="ingreso_cantidad" aria-describedby="emailHelp" placeholder="Ej: 3" value="1">
                                                    </div>
                                                    <div class="form-group bmd-form-group">
                                                        <label for="exampleInputEmail1" class="bmd-label-static">Monto</label>
                                                        <input type="input" class="form-control" id="monto" aria-describedby="emailHelp" placeholder="Monto" value="">
                                                    </div>
                                                    <div class="form-group bmd-form-group">
                                                        <input onclick="$('#formadepagodigital').removeClass('d-none');" type="checkbox" id="ingreso_mercadopago" value="1"> <label for="cbox2"> Pago Digital</label>
                                                    </div>
                    
                                                    <div class="form-group bmd-form-group">
                                                        <label for="exampleInputEmail1" class="bmd-label-static">Observaciones</label>
                                                        <input type="input" class="form-control" id="ingresos_observaciones" aria-describedby="emailHelp" placeholder="Observaciones">
                                                    </div>
                    
                                                    <div id="formadepagodigital" class="form-group bmd-form-group d-none">
                                                      <label for="exampleFormControlInput1">Medio de Pago Digital</label>
                                                        <select id="formadepagodigitalselector" class="js-example-basic-single form-control" name="state">
                                                          <option value="">Seleccione...</option>
                                                          <option value="MercadoPago">MercadoPago</option>
                                                          <option value="TodoPago">TodoPago</option>
                                                        </select>
                                                    </div>
                    
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" class="btn btn-primary" onclick="create_income()">Guardar Ingreso</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                    
                                            <!-- Cargar un Egreso -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#egreso">
                                              Cargar un Egreso
                                            </button>
                                            <div class="modal fade" id="egreso" tabindex="-1" role="dialog" aria-labelledby="egresoLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document" style="top: 200px;">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="egresoLabel">Cargar Egreso</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div id="selectoption" class="form-group  bmd-form-group">
                                                        <label for="exampleFormControlInput1">Egreso</label>
                                                        <select id="egreso_tipo" class="js-example-basic-single form-control" name="state">
                                                          <option value="">Egreso</option>
                                                          @for ($i = 1; $i <= 20; $i++)
                                                              @php 
                                                                $serviceName = $outcomes[0]->{'service' . $i}; 
                                                              @endphp
                                                              @if(null !== $serviceName)
                                                                <option value="{{$serviceName}}">{{$serviceName}}</option>
                                                              @endif
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="form-group bmd-form-group">
                                                        <label for="exampleInputEmail1" class="bmd-label-static">Monto (sin $, ni decimales ni separador de miles)</label>
                                                        <input type="input" class="form-control" id="egreso_monto" aria-describedby="emailHelp" placeholder="Ej: 300">
                                                    </div>
                                                    <div class="form-group bmd-form-group">
                                                        <label for="exampleInputEmail1" class="bmd-label-static">Observaciones</label>
                                                        <input type="input" class="form-control" id="egreso_observaciones" aria-describedby="emailHelp" placeholder="Observaciones">
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" class="btn btn-primary" onclick="create_outcome()">Guardar Egreso</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          @else
                                            <p style="color: red;" class="mr-5">Estás viendo un dia previo,<br>no puedes cargar movimientos en dias previos,<br>solo puedes cerrarlos.</p>
                                          @endif
                    
                                          <!-- Efectuar Cierre -->
                                          @if($day == date('Y-m-d') && $countClose == 0  && $countClosesAfterToday == 0 || $day < date('Y-m-d') && $countCloseThisDay == 0 && $countClosesAfterToday == 0 )
                                          @if(Auth::user()->profiletype == 1)
                                              <button type="button" class="btn btn-danger" onclick="closeDay();">
                                                Cerrar el Día (No Reversible)
                                              </button>
                                            @endif
                                          @endif
                    
                                          @if(Auth::user()->profiletype == 1)
                                          <div class="col-md-12">
                                            <br>
                                                <table class="table borderless table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th scope="col" class="text font-weight-bold text-primary" style="background: lightgray;">MovID</th>
                                                        <th scope="col" class="text font-weight-bold text-primary" style="background: lightgray;">Concepto</th>
                                                        <th scope="col" class="text font-weight-bold text-primary" style="background: lightgray;">Debe</th>
                                                        <th scope="col" class="text font-weight-bold text-primary" style="background: lightgray;">Haber</th>
                                                        <th scope="col" class="text font-weight-bold text-primary" style="background: lightgray;">Forma de Pago</th>
                                                        <th scope="col" class="text font-weight-bold text-primary" style="background: lightgray;">Saldo</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody id="tableCash">
                                                        @php $cash = $prevC->result; @endphp
                                                        <tr @php if($prevC->concept == 'Cierre y Ajuste de Caja ()' || $prevC->concept == 'Cierre y Ajuste de Caja'): echo 'style="background: lightgray;"'; endif; @endphp>
                                                          <td>{{$prevC->id}}</td>
                                                          <td>{{$prevC->concept}} <strong>PREVIO</strong></td>
                                                          @if($prevC->type == 'debe')
                                                            @php $cash -= $prevC->finalammout; @endphp
                                                            <td>$ {{$prevC->finalammout}}</td>
                                                            <td></td>
                                                          @else
                                                            <td></td>
                                                            @php $cash += $prevC->finalammout; @endphp
                                                            <td>$ {{$prevC->finalammout}}</td>
                                                          @endif
                                                          <td></td>
                                                          <td>$ {{$cash}}</td>
                                                        </tr>
                                                        @foreach($movements as $movD)
                                                          <tr @php if($movD->concept == 'Cierre y Ajuste de Caja ()' || $movD->concept == 'Cierre y Ajuste de Caja' || $movD->concept == 'Cierre y Ajuste de Caja (Sin Faltantes) ()'): echo 'style="background: red; color: white;"'; endif; @endphp>
                                                            <td>{{$movD->id}}</td>
                                                            <td>{{$movD->concept}}</td>
                                                            @if($movD->type == 'debe')
                                                              <td>$ {{$movD->finalammout}}</td>
                                                              @php $cash -= $movD->finalammout; @endphp
                                                              <td></td>
                                                            @else
                                                              <td></td>
                                                              <td>$ {{$movD->finalammout}}</td>
                                                              @php 
                                                                if($movD->paymentmethod == 'Efectivo'):
                                                                  $cash += $movD->finalammout; 
                                                                endif;
                                                              @endphp
                                                            @endif
                                                            <td>{{$movD->paymentmethod}}</td>
                                                            <td>$ {{$cash}}</td>
                                                          </tr>
                                                        @endforeach
                                                    </tbody>
                    
                                                    <input type="hidden" id="lastAmmount" value="{{$cash}}">
                                                </table>
                                          </div>
                                        @endif
                    
                                      @endif
                    
                                      @if(Auth::user()->profiletype == 1)
                                        <hr style="border-top: 1px solid lightgray; width: 100%;">
                    
                                        @if(isset($incomesResumeMonthly) && isset($outcomesResumeMonthly))
                                          <div class="row">
                                            <div class="">
                                              <h4>Balance del Mes Corriente (Unicamente de esta Caja)</h4>
                                              <table class="table borderless table-hover" style="max-width: 350px;">
                                                  <thead>
                                                    <tr>
                                                      <th scope="col" class="text font-weight-bold text-primary" style="background: lightgray;">Ingresos</th>
                                                      <th scope="col" class="text font-weight-bold text-primary" style="background: lightgray;">Egresos</th>
                                                      <th scope="col" class="text font-weight-bold text-primary" style="background: lightgray;">Resultado</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tableCash">
                                                      <tr>
                                                        <td>$ {{$incomesResumeMonthly[0]->Suma}}</td>
                                                        <td>$ {{$outcomesResumeMonthly[0]->Suma}}</td>
                                                        <td>$ 
                                                          @php
                                                                  echo $incomesResumeMonthly[0]->Suma - $outcomesResumeMonthly[0]->Suma;
                                                          @endphp
                                                        </td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                    
                                              <ul>
                                                <li>Los pagos digitales también son considerados en estos montos.</li>
                                                <li>Automáticamente, al cambiar de mes y pasar a ser 01 del nuevo mes, estos valores se reiniciarán a cero sin acción alguna. Asegúrate de el ultimo dia de cada mes ver este balance.</li>
                                                <li>Si estás consultando este balance ANTES de que termine el mes, estás viendo la imagen de este mismo dia. La cual irá mutando a medida que el mes continue.</li>
                                              </ul>
                                            </div>
                                          </div>
                                        @endif
                                      @endif
                    
                                  </div>
                              </div>
                          </div>
                      </form>
                    
                      <script>
                        $( function() {
                          $( ".datepicker1" ).datepicker({ format: 'yyyy-mm-dd' });
                          $( ".datepicker2" ).datepicker({ format: 'dd/mm/yyyy' });
                        } );
                      </script>
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

<!--SCRIPTS-->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</body>

</html>
