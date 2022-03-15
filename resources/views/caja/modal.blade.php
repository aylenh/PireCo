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
                        <input type="text" class="form-control" id="cliente_distribuidor" name="cliente_distribuidor">
                        <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="devolucion">Monto
                                        </label>
                                        <input type="number" class="form-control" id="monto" name="monto">
                                    </div>
                                    <div class="col">
                                        <label for="fecha">Fecha
                                        </label>
                                        <input type="date" class="form-control" id="fecha" name="fecha">
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
        <script>
        function distribuidor() {
        var x = document.getElementById("distribuidor");
        var mes = document.getElementById("cliente");
        if (x.style.display === "none") {
            x.style.display = "block";
            mes.style.display = "none";
        } else {
            x.style.display = "none";
            mes.style.display = "none";
        }
    }
    function cliente() {
        var x = document.getElementById("cliente");
        var dia = document.getElementById("distribuidor");
        if (x.style.display === "none") {
            x.style.display = "block";
            dia.style.display = "none";
        } else {
            x.style.display = "none";
            dia.style.display = "none";
        }
    }
    </script>