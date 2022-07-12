<!-- Modal -->
<div class="modal fade editarProductomodal" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="<?= route('actualizar.producto') ?>" method="post" id="actualizarProducto">
                    <input type="hidden" name="producto_id" id="producto_id">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="">Nombre producto</label>
                                <input type="text" name="producto_botella" id="producto_botella" class="form-control" placeholder="" aria-describedby="helpId">
                                <span class="text-danger error-text producto_botella_error"> </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="">Tipo producto</label>
                                <select class="form-select" aria-label="Default select example" name="producto_descartable" selected>
                                    <option value="Descartable">Descartable</option>
                                    <option value="Retornable" selected>Retornable</option>
                                </select>
                                  <span class="text-danger error-text producto_descartable_error"> </span>

                            </div>
                            <div class="col">
                                <label for="">Litros</label>
                                <input type="number" name="producto_litros" id="producto_litros" class="form-control" placeholder="" aria-describedby="helpId">
                                <span class="text-danger error-text producto_litros_error"> </span>

                            </div>
                          </div>
                          <div class="form-row">
                            <div class="col">
                                <label for="">Unidades disponibles</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="" aria-describedby="helpId">
                                <span class="text-danger error-text cantidad_error"> </span>

                            </div>
                    
                            <div class="col">
                                <label for="">Precio</label>
                                <input type="text" name="producto_precio" id="producto_precio" class="form-control" placeholder="" aria-describedby="helpId">
                                <span class="text-danger error-text producto_precio_error"> </span>
                          </div>
                          <div class="col-12">
                            <label for="">Imagen</label>
                            <img src="" id="imagen1" alt="" width="60px" height="60px">
                            {{-- <input type="text" name="imagen" id="imagen"> --}}
                            <input type="file" name="imagen" id="imagen" class="form-control" placeholder="" aria-describedby="helpId">
                            <span class="text-danger error-text imagen_precio_error"> </span>
                      </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
