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
                        <h1 class="h3 mb-0 text-gray-800">Productos</h1>
                    </div>

                    <div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Agregar un nuevo producto</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('save.producto') }}" method="POST"
                                    enctype="multipart/form-data" id="saveProducto">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <label for="floatingInputGrid">Envase</label>
                                            <input type="text" class="form-control" name="producto_botella"
                                                placeholder="Ingresar tipo de envase">
                                            <span class="text-danger error-text producto_botella_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Descartable o retornable</label>
                                            <select class="form-select" aria-label="Default select example" name="producto_descartable">
                                                <option selected>Selecciona descartable o retornable</option>
                                                <option value="Descartable">Descartable</option>
                                                <option value="Retornable">Retornable</option>
                                              </select>
                                            <span class="text-danger error-text producto_descartable_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Cantidad de litros</label>
                                            <input type="number" class="form-control" name="producto_litros"
                                                placeholder="Ingresar Cantidad de litros">
                                            <span class="text-danger error-text producto_litros_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Precio</label>
                                            <input type="number" class="form-control" name="producto_precio"
                                                placeholder="Ingresar Precio">
                                            <span class="text-danger error-text producto_precio_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                            </div>
                        </div>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Lista de productos</h6>
                            </div>
                            <div class="card-body" id="allProductos">

                            </div>
                        </div>
                        @include('productos.edit-producto-modal')
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@include('includes.footer')

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
                    $(producto_modal).find('form').find('input[name="producto_botella"]').val(data.result.producto_botella);
                    $(producto_modal).find('form').find('input[name="producto_descartable"]').val(data.result.producto_descartable);
                    $(producto_modal).find('form').find('input[name="producto_litros"]').val(data.result.producto_litros);
                    $(producto_modal).find('form').find('input[name="producto_precio"]').val(data.result.producto_precio);
                    $(producto_modal).find('form').find('span.error-text').text('');
                    $(producto_modal).modal('show');
                }, 'json');
            });

            //Update producto modal
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
                            fetchAllProductos();
                            $('.editProductoModal').modal('hide');
                        }
                    }
                })
            });

            //Funcion boton eliminar producto

            $(document).on('click', '#eliminarBtn', function(){
                var producto_id = $(this).data('id');
                var url = '{{route("delete.producto")}}';

                if(confirm('Estas seguro de eliminar este producto?')){
                    $.ajax({
                        headers:{
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        },
                        url:url,
                        method:'POST',
                        data:{producto_id:producto_id},
                        dataType:'json',
                        success:function(data){
                            if(data.code == 1){
                                fetchAllProductos();
                            }else{
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

</body>

</html>
