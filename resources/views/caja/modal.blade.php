<div class="modal fade" id="modalEgreso" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar movimiento de egreso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                        </div>
                <div class="modal-body">
                    <form name="formulario"  action="{{ route('crear.egreso') }} " method="POST" >
                        @csrf 
                        <label for="devolucion">Cliente/Distribuidor
                        </label>
                        {{-- <textarea name="nota" id="nota" cols="15" rows="5"></textarea> --}}
                        <input type="text" class="form-control" id="cliente_distribuidor" name="cliente_distribuidor" required>
                        <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="devolucion">Monto
                                        </label>
                                        <input type="number" class="form-control" id="monto" name="monto" required>
                                    </div>
                                    <div class="col">
                                        <label for="fecha">Fecha
                                        </label>
                                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                                    </div>
                                  </div>
                                <br>
                             
                                <label for="devolucion">Nota
                                </label>
                                {{-- <textarea name="nota" id="nota" cols="15" rows="5"></textarea> --}}
                                <input type="text" class="form-control" id="nota" name="nota">
                                <br>
                        <button type="submit" class="btn btn-warning" id="devolucionBidones">Guardar</button>   
                    </form>
                </div>
            </div>
        </div>
    </div>