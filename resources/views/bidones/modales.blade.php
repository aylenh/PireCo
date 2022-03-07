<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Devolución de bidones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                        </div>
                <div class="modal-body">
                    <form name="formulario"  action="{{ route('inventario.bidones') }} " method="POST" >
                        @csrf 
                                <div class="form-row">
                                    <div class="col">
                                        <button type="button" class="btn btn-dark" style="background-color: #4E73DF;" onclick="cliente();">Cliente</button>
                                        <button type="button" class="btn btn-dark" style="background-color: #4E73DF;" onclick="distribuidor();">Distribuidor
                                        </button>
                                    </div>
                                </div>
                                <br>
                                <div id="distribuidor" style="display: none;">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="inputState">Distribuidor</label>
                                            <select class="form-control" name="distribuidores" id="distribuidores">
                                                <option value="000" selected disabled>--Seleccione un distribuidor --</option> 
                                                @foreach ($bidones as $bi)
                                                @if($bi->distribuidores()->exists())        
                                                    <option value="{{$bi->distribuidores->id}}">{{$bi->distribuidores->distribuidor_local}}</option>  
                                                @endif
                                            @endforeach 
                                     
                                            </select>
                                        </div>
                                      
                             
                                    </div>
                                </div>
                                <div id="cliente" style="display: none;">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="inputState">Cliente</label>
                                            <select class="form-control" name="clientes" id="clientes">
                                                <option value="000" selected disabled>--Seleccione un cliente --</option>  
                                                @foreach ($bidones as $bi)
                                                    @if ($bi->distribuidor_id == null)
                                                        <option value="{{$bi->cel_cliente}}">{{$bi->nombre}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <label for="devolucion">Bidones devueltos
                                </label>
                                <input type="number" class="form-control" id="devolucion" name="devolucion">
                                <br>
                                
                             
                                <label for="inputState">Tipo Bidón</label>
                                <select class="form-control" name="litro" id="litro">
                                <option value="" selected disabled>--Seleccione litro --</option>  
                                    <option value="1">Bidón(10L)</option>
                                    <option value="2">Bidón(20L)</option>
                                </select>     
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