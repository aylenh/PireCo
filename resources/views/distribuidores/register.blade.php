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
                                                name="distribuidor_ubicacion" placeholder="Ingresar ubicacion del local">
                                            <span class="text-danger error-text distribuidor_ubicacion_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Latitude</label>
                                            <input id="lat" type="text" class="form-control" name="distribuidor_latitude" placeholder="Latitude">
                                            </div>
                                            <div class="col">
                                            <label for="floatingInputGrid">Longitude</label>
                                            <input id="lng" type="text" class="form-control" name="distribuidor_longitude" placeholder="Longitude">
                                            </div>
                                       <!-- <div class="col">
                                            <label for="floatingInputGrid">Imagen del Local</label>
                                            <input class="form-control" type="file" name="distribuidor_imagen">
                                            <span class="text-danger error-text distribuidor_imagen_error"></span>
                                        </div>
                                        <div class="img-holder"></div> -->
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
@include('includes.footer')
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
                    latitude: '',
                    longitude: ''
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
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
