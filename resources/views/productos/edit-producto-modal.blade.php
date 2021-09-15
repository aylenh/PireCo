<div class="modal fade editProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update.producto')}}" method="POST" enctype="multipart/form-data" id="update_form">
                    @csrf
                    <input type="hidden" name="pid">
                    <div class="form-group">
                        <label for="floatingInputGrid">Selecciona bidon o botella</label>
                        <select class="form-select" aria-label="Default select example" name="producto_botella">
                            <option selected>Selecciona bidon o botella</option>
                            <option value="Bidon">Bidon</option>
                            <option value="Botella">Botella</option>
                          </select>
                        <span class="text-danger error-text producto_botella_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="floatingInputGrid">Selecciona descartable o retornable</label>
                        <select class="form-select" aria-label="Default select example" name="producto_descartable">
                            <option selected>Selecciona descartable o retornable</option>
                            <option value="Descartable">Descartable</option>
                            <option value="Retornable">Retornable</option>
                          </select>
                        <span class="text-danger error-text producto_descartable_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="floatingInputGrid">Cantidad de litros</label>
                        <input type="number" class="form-control" name="producto_litros"
                            placeholder="Ingresar Cantidad de litros">
                        <span class="text-danger error-text producto_litros_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="floatingInputGrid">Precio</label>
                        <input type="number" class="form-control" name="producto_precio"
                            placeholder="Ingresar Precio">
                        <span class="text-danger error-text producto_precio_error"></span>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
