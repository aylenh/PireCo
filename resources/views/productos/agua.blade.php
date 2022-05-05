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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
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
                                <form id="guardarProducto" action="{{ route('save.producto') }}" method="post" >
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <label for="floatingInputGrid">Envase</label>
                                            <input type="text" class="form-control" name="producto_botella" placeholder="Ingresar tipo de envase">
                                            <span class="text-danger error-text producto_botella_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Descartable o retornable</label>
                                            <select class="form-select" aria-label="Default select example" name="producto_descartable">
                                                <option selected disabled>-- Selecciona una opción --</option>
                                                <option value="Descartable">Descartable</option>
                                                <option value="Retornable">Retornable</option>
                                              </select>
                                            <span class="text-danger error-text producto_descartable_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Litros</label>
                                            <input type="number" class="form-control" name="producto_litros" placeholder="Ingresar Cantidad de litros">
                                            <span class="text-danger error-text producto_litros_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Cantidad</label>
                                            <input type="number" class="form-control" name="cantidad"  placeholder="Ingresar Cantidad de litros">
                                            <span class="text-danger error-text cantidad_error"></span>
                                        </div>
                                        <div class="col">
                                            <label for="floatingInputGrid">Precio</label>
                                            <input type="number" class="form-control" name="producto_precio" placeholder="Ingresar Precio">
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
                                <h3 class="m-0 font-weight-bold text-primary">Lista de productos</h3> <br>
                                <table class="table table-hover table-codensed" id="listadoProductos">
                                    <thead>
                                        <th><input type="checkbox" name="main_checkbox" id=""></th>
                                        <th>Producto</th>
                                        <th>Tipo</th>
                                        <th>Litros</th>
                                        <th>Unidades</th>
                                        <th>Precio</th>
                                        <th>Acciones <button class="btn btn-sm btn-danger d-none" id="borrarTodo">Borrar todo</button></th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                           
                            </div>
                        </div>
                        @include('productos.editar_producto')
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('includes.footer')


    {{-- funciones creadas por paula caicedo  --}}
    {{-- funciones ajax para el manejo de informacion de productos  --}}
    <script>
        // funciones ajax 
        toastr.options.preventDuplicates = true;

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function(){
            // agregar nuevo producto 
            $('#guardarProducto').on('submit', function(e){
                e.preventDefault();
                var form = this;

                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code == 0){
                            $.each(data.error, function(prefix, val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $(form)[0].reset();
                            $('#listadoProductos').DataTable().ajax.reload(null, false);
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.msg,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    }
                });
            });
            // inicio tabla 
            $('#listadoProductos').DataTable({
                language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                    }
                },
                processing:true,
                info:true,
                ajax:"{{url('mostrarProductos')}}",
                "pageLength":5,
                "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50, "Todos"]],
                columns:[
                    {data:'checkbox', name:'checkbox', orderable:false, searchable:false},
                    {data:'producto_botella', name:'producto_botella'},
                    {data:'producto_descartable', name:'producto_descartable'},
                    {data:'producto_litros', name:'producto_litros'},
                    {data:'cantidad', name:'cantidad'},
                    {data:'producto_precio', name:'producto_precio'},
                    {data:'Acciones', name:'Acciones', orderable:false, searchable:false},
                ]
                // seleccionar solo los registros de una paginacion 
            }).on('draw', function(){
                $('input[name="check_producto"]').each(function(){this.checked = false;});
                $('input[name="main_checkbox"]').prop('checked', false);
                $('button#borrarTodo').addClass('d-none');
            });
            
            // fin tabla 

            //editar un producto 
            $(document).on('click', '#editarProducto', function(){
                var producto_id = $(this).data('id');
                $('.editarProductomodal').find('form')[0].reset();
                $('.editarProductomodal').find('span-error-text').text('');
                $.post('<?= route("editar.producto") ?>',{producto_id:producto_id}, function(data){
                    $('.editarProductomodal').find('input[name="producto_id"]').val(data.editar.id);
                    $('.editarProductomodal').find('input[name="producto_botella"]').val(data.editar.producto_botella);
                    $('.editarProductomodal').find('input[name="producto_descartable"]').val(data.editar.producto_descartable);
                    $('.editarProductomodal').find('input[name="producto_litros"]').val(data.editar.producto_litros);
                    $('.editarProductomodal').find('input[name="cantidad"]').val(data.editar.cantidad);
                    $('.editarProductomodal').find('input[name="producto_precio"]').val(data.editar.producto_precio);
                    $('.editarProductomodal').modal('show');
                },'json');
            });

            // actualizar producto  
            $('#actualizarProducto').on('submit', function(e){
                e.preventDefault();
                var form = this;

                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend: function(){

                    },
                    success:function(data){
                        if(data.code == 0){
                            $.each(data.error, function(prefix, val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $('#listadoProductos').DataTable().ajax.reload(null, true);
                            $('.editarProductomodal').modal('hide');
                            $('.editarProductomodal').find('form')[0].reset();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.msg,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    }

                })
            });

            // borrrar un solo producto 
            $(document).on('click', '#eliminarProducto', function(){
                var producto_id = $(this).data('id');
                // alert(producto_id);
                var url = '<?= route("borrar.producto") ?>';
                Swal.fire({
                        title:'¿Esta seguro?',
                        html:'Usted <b>borrará</b> este producto ',
                        showCancelButton:true,
                        showCloseButton:true,
                        confirmButtonText:'Si, Borrar',
                        cancelButtonText:'Cancelar',
                        confirmButtonColor:'#556ee6',
                        cancelButtonColor:'#d33',
                        width:300,
                        allowOutsideClick:false
                    }).then(function(result){
                        if(result.value){       
                            $.post(url, {producto_id:producto_id}, function(data){
                                if (data.code == 1) {
                                    $('#listadoProductos').DataTable().ajax.reload(null, true);
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: data.msg,
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }else{
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: data.msg,
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            },'json');
                        }
                    });
                });
            
            // seleccioinar todos los checkbox desde el th 
            $(document).on('click', 'input[name="main_checkbox"]', function(){
                if(this.checked){
                    $('input[name="check_producto"]').each(function(){
                        this.checked = true;
                    });
                }else{
                    $('input[name="check_producto"]').each(function(){
                        this.checked = false;
                    });
                }
                borrartodocheck();
            });

            // seleccioinar todos los checkbox desde el th 
            $(document).on('change', 'input[name="check_producto"]', function(){
                if ($('input[name="check_producto"]').length == $('input[name="check_producto"]:checked').length) {
                    $('input[name="main_checkbox').prop('checked', true);
                } else {
                    $('input[name="main_checkbox"]').prop('checked', false);
                }
                borrartodocheck();
            });
            
            // boton, mostrar  ocultar boton de borrar varios 
            function borrartodocheck(){
                if ($('input[name="check_producto"]:checked').length > 0) {
                    $('button#borrarTodo').text('Borrar ('+$('input[name="check_producto"]:checked').length+')').removeClass('d-none');
                }else{
                    $('button#borrarTodo').addClass('d-none');
                }
            }

            // borrar registros multiples con checkbox
            $(document).on('click', 'button#borrarTodo', function(){
                var checkedProductos =  [];
                $('input[name="check_producto"]:checked').each(function(){
                    checkedProductos.push($(this).data('id'));
                });
                var url = '{{route("borrar.producto.check")}}';
                if (checkedProductos.length > 0) {
                    Swal.fire({
                        title:'¿Esta seguro?',
                        html:'Usted borrrara <b>('+checkedProductos.length+')</b> productos',
                        showCancelButton:true,
                        showCloseButton:true,
                        confirmButtonText:'Si, Borrar',
                        cancelButtonText:'Cancelar',
                        confirmButtonColor:'#556ee6',
                        cancelButtonColor:'#d33',
                        width:300,
                        allowOutsideClick:false
                    }).then(function(result){
                        if(result.value){       
                            $.post(url, {productos_ids:checkedProductos}, function(data){
                                if (data.code == 1) {
                                    $('#listadoProductos').DataTable().ajax.reload(null, true);
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: data.msg,
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            },'json');
                        }
                    })
                }
            });
        // fin ajax funciones 
        });

         
        </script>
    

    <!--SCRIPTS-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>