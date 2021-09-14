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

    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyDby2E_JbzX-Rmb0v4lE9z62T5TAdkLyh8&libraries=places&callback=initAutocomplete"
        type="text/javascript"></script>



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
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Pireco</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/home') }}">
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
                        <h1 class="h3 mb-0 text-gray-800">Distribuidores</h1>
                    </div>

                    <div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Agregar un nuevo distribuidor</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('save.distribuidor') }}" method="POST"
                                    enctype="multipart/form-data" id="saveDistribuidor">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <label for="floatingInputGrid">Nombre Local</label>
                                            <input type="text" class="form-control" name="distribuidor_local"
                                                placeholder="Ingresar Nombre del Local">
                                            <span class="text-danger error-text distribuidor_local_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="distribuidor_correo"
                                                placeholder="Ingresar Correo Electrónico">
                                            <span class="text-danger error-text distribuidor_correo_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Numero de Contacto</label>
                                            <input type="number" class="form-control" name="distribuidor_contacto"
                                                placeholder="Ingresar Numero de contacto">
                                            <span class="text-danger error-text distribuidor_contacto_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Ubicación del Local</label>
                                            <input id="location" type="text" class="form-control"
                                                name="distribuidor_ubicacion" placeholder="Ubicacion">
                                            <span class="text-danger error-text distribuidor_ubicacion_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Imagen del Local</label>
                                            <input class="form-control" type="file" name="distribuidor_imagen">
                                            <span class="text-danger error-text distribuidor_imagen_error"></span>
                                        </div>
                                        <div class="img-holder"></div>
                                    </div>
                                    <br>
                                    <label for="floatingInputGrid">Selecciona la ubicación del local en el mapa</label>
                                    <div id="us2" style="width: 500px; height: 400px;"></div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                            </div>
                        </div>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Lista de distribuidores</h6>
                            </div>
                            <div class="card-body" id="allDistribuidores">

                            </div>
                        </div>
                        @include('distribuidores.edit-distribuidor-modal')
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PireCo 2021</span>
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
            $('#saveDistribuidor').on('submit', function(e) {
                e.preventDefault();

                var saveDistribuidor = this;
                $.ajax({
                    url: $(saveDistribuidor).attr('action'),
                    method: $(saveDistribuidor).attr('method'),
                    data: new FormData(saveDistribuidor),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(saveDistribuidor).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.code == 0) {
                            $.each(data.error, function(prefix, val) {
                                $(saveDistribuidor).find('span.' + prefix + '_error')
                                    .text(val[0]);
                                console.log(data.error);
                            });
                        } else {
                            $(saveDistribuidor)[0].reset();
                            fetchAllDistribuidores();
                        }
                    }
                });
            });

            //Reset input file
            $('input[type="file"][name="distribuidor_imagen"]').val('');
            //Image preview
            $('input[type="file"][name="distribuidor_imagen"]').on('change', function() {
                var img_path = $(this)[0].value;
                var img_holder = $('.img-holder');
                var extension = img_path.substring(img_path.lastIndexOf('.') + 1).toLowerCase();
                if (extension == 'jpeg' || extension == 'jpg' || extension == 'png') {
                    if (typeof(FileReader) != 'undefined') {
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('<img/>', {
                                'src': e.target.result,
                                'class': 'img-fluid',
                                'style': 'max-width:100px;margin-bottom:10px;'
                            }).appendTo(img_holder);
                        }
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                    } else {
                        $(img_holder).html('This browser does not support FileReader');
                    }
                } else {
                    $(img_holder).empty();
                }
            });

            //Fetch all products
            fetchAllDistribuidores();

            function fetchAllDistribuidores() {
                $.get('{{ route('fetch.distribuidores') }}', {}, function(data) {
                    $('#allDistribuidores').html(data.result);
                }, 'json');
            }

            //Funcion Boton Editar Distribuidor
            $(document).on('click', '#editarBtn', function() {
                var distribuidor_id = $(this).data('id');
                var url = '{{ route('get.distribuidores.details') }}';
                $.get(url, {
                    distribuidor_id: distribuidor_id
                }, function(data) {
                    //alert(data.result.distribuidor_local);
                    var distribuidor_modal = $('.editDistribuidorModal');

                    $(distribuidor_modal).find('form').find('input[name="pid"]').val(data.result.id);
                    $(distribuidor_modal).find('form').find('input[name="distribuidor_local"]').val(data.result.distribuidor_local);
                    $(distribuidor_modal).find('form').find('input[name="distribuidor_correo"]').val(data.result.distribuidor_correo);
                    $(distribuidor_modal).find('form').find('input[name="distribuidor_contacto"]').val(data.result.distribuidor_contacto);
                    $(distribuidor_modal).find('form').find('input[name="distribuidor_ubicacion"]').val(data.result.distribuidor_ubicacion);
                    $(distribuidor_modal).find('form').find('.img-holder-update').html('<img src="/storage/files/'+data.result.distribuidor_imagen+'" class="img-fluid" style="max-width:100px;margin-botton:10px;">');
                    $(distribuidor_modal).find('form').find('input[type="file"]').attr('data-value', '<img src="/storage/files/'+data.result.distribuidor_imagen+'" class="img-fluid" style="max-width:100px;margin-botton:10px;">');
                    $(distribuidor_modal).find('form').find('input[type="file"]').val('');
                    $(distribuidor_modal).find('form').find('span.error-text').text('');
                    $(distribuidor_modal).modal('show');
                }, 'json');
                //alert(distribuidor_id);
            });

            $('input[type="file"][name="distribuidor_imagen_update"]').on('change', function(){
                var img_path = $(this)[0].value;
                var img_holder = $('.img-holder-update');
                var currentImagePath = $(this).data('value');
                var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
                if(extension == 'jpg' || extension == 'jpeg' || extension == 'png'){
                    if(typeof(FileReader) != 'undefined'){
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('<img/>',{'src':e.target.result, 'class':'img-fluid', 'style':'max-width:100px;margin-bottom:10px;'}).appendTo(img_holder);
                        }
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                    }else{
                        $(img_holder).html('Este explorador no soporta Archivos');
                    }
                }else{
                    $(img_holder).html(currentImagePath);
                }
            });

            $(document).on('click', '#clearInputFile', function(){
                var form = $(this).closest('form');
                $(form).find('input[type="file"]').val('');
                $(form).find('.img-holder-update').html($(form).find('input[type="file"]').data('value'));
            });

            //Update distribuidor modal
            $('#update_form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code == 0){
                            $.each(data.error, function(prefix, val){
                                $(form).find('span'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            alert(data.msg);
                            fetchAllDistribuidores();
                            $('.editDistribuidorModal').modal('hide');
                        }
                    }
                })
            });

            //Funcion boton eliminar distribuidor

            $(document).on('click', '#eliminarBtn', function(){
                var distribuidor_id = $(this).data('id');
                var url = '{{route("delete.distribuidor")}}';

                if(confirm('Estas seguro de eliminar esta distribuidora?')){
                    $.ajax({
                        headers:{
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        },
                        url:url,
                        method:'POST',
                        data:{distribuidor_id:distribuidor_id},
                        dataType:'json',
                        success:function(data){
                            if(data.code == 1){
                                fetchAllDistribuidores();
                            }else{
                                alert(data.msg);
                            }
                        }
                    });
                }
                
            });
        })
    </script>

    <script type="text/javascript"
        src="https://rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.js"></script>
    <script>
        $(function() {

            $('#us2').locationpicker({
                location: {
                    latitude: -34.60568597314354,
                    longitude: -58.39267297656248
                },
                radius: 0,
                inputBinding: {
                    latitudeInput: $('#lat'),
                    longitudeInput: $('#lng'),
                    locationNameInput: $('#location')
                },
                enableAutocomplete: true,
                onchanged: function(currentLocation, radius, isMarkerDropped) {
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });


        });
    </script>

<script>
    $(function() {

        $('#updateMap').locationpicker({
            location: {
                latitude: -34.60568597314354,
                longitude: -58.39267297656248
            },
            radius: 0,
            inputBinding: {
                latitudeInput: $('#updateLat'),
                longitudeInput: $('#updateLng'),
                locationNameInput: $('#updateLocation')
            },
            enableAutocomplete: true,
            onchanged: function(currentLocation, radius, isMarkerDropped) {
            }
        });


    });
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>


    <!--SCRIPTS-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
