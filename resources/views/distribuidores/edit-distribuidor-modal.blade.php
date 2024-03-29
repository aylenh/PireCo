<div class="modal fade editDistribuidorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Distribuidor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update.distribuidor')}}" method="POST" enctype="multipart/form-data"  id="update_form">
                    @csrf
                    <input type="hidden" name="pid">
                    <div class="row">
                        <div class="col">
                            <label for="">Nombre Local</label>
                            <input type="text" class="form-control" name="distribuidor_local"
                                placeholder="Ingresa el nombre del local nuevo">
                            <span class="text-danger error-text distribuidor_local_error"></span>
                        </div>
                        <div class="col">
                            <label for="">Celular</label>
                            <input type="number" class="form-control" name="distribuidor_contacto"
                                placeholder="Ingresa el numero de contacto nuevo">
                            <span class="text-danger error-text distribuidor_contacto_error"></span>
                        </div>
                        <div class="col">
                            <label for="">Ubicacion</label>
                            <input id="updateLocation" type="text" class="form-control" name="distribuidor_ubicacion"
                                placeholder="Ingresa la ubicacion nueva">
                            <span class="text-danger error-text distribuidor_ubicacion_error"></span>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col">
                            <label for="">Latitud</label>
                            <input id="updateLat" type="text" class="form-control" name="distribuidor_latitude"
                                placeholder="Ingresa la ubicacion nueva">
                            <span class="text-danger error-text distribuidor_ubicacion_error"></span>
                        </div>
                        <div class="col">
                            <label for="">Longitud</label>
                            <input id="updateLng" type="text" class="form-control" name="distribuidor_longitude"
                                placeholder="Ingresa la ubicacion nueva">
                            <span class="text-danger error-text distribuidor_ubicacion_error"></span>
                        </div>
                      </div>
                      <br>
                    

                    <div id="updateMap" style="width: 420px; height: 300px;"></div>
                    <br>
                   <!-- <div class="form-group">
                        <label for="">Imagen Distribuidor <button id="clearInputFile" type="button" class="btn btn-danger btn-sm">Eliminar</button></label>
                        <input type="file" name="distribuidor_imagen_update" class="form-control" data-value="">
                        <span class="text-danger error-text istribuidor_imagen_update_error"></span>
                    </div>
                    <div class="img-holder-update"></div> -->
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>