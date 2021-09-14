@extends('general')

@section('content')

<form></form>
      <div class="container my-lg">
          <h2 class="doc-section-title" id="title">Administración de Remitos<a class="section-link" href="#examples"></a><span class="border-bottom"></span>
          <a class="btn btn-raised-primary mr-3" href="{{route('remitosprint.index')}}">Imprimir Remitos entre Fechas</a>
          </h2>
          <div class="doc-example" style="overflow: scroll;">
              <div class="row">
                  <div class="col-md-12">
                      <form>
                          <script type="text/javascript">
                            function remitosRender() 
                            {
                                if( $('#idCLient option:selected').val() )
                                {
                                  let url = "{{ route('remitos.render', ['client' => 1111111, 'day' => 22222]) }}".replace('1111111', $('#idCLient option:selected').val()).replace('22222', $('#fecha').val());
                                  window.location.href = url;
                                }
                            }
                          </script>

                          <div id="selectoption" class="form-group">
                              <label for="exampleFormControlInput1">Cliente</label>
                              <select onchange="remitosRender();" id="idCLient" class="js-example-basic-single form-control" name="state">
                                <option value="">Seleccione un cliente...</option>
                                @foreach($clientes as $client)
                                  @if($clientId == $client->id)
                                    <option selected="selected" value="{{$client->id}}">{{$client->rsocial}}</option>
                                  @else
                                    <option value="{{$client->id}}">{{$client->rsocial}}</option>
                                  @endif
                                @endforeach
                              </select>
                          </div>
                          
                          <div id="selectoption" class="form-group">
                              <label for="exampleFormControlInput1">Fecha</label>
                              <input onchange="remitosRender()" id="fecha" class="form-control datepicker1" type="text" value="@php 
                                if(isset($day)): echo $day; else: echo date('Y-m-d'); endif;
                              @endphp" placeholder="Fecha">
                          </div>
                          <!-- Remitos management -->
                          
                          @if(isset($clientId))

                          <div class="alert alert-danger" role="alert">
                            Total de ventas en este mes: <strong style="font-size: 20px;">${{$finalAmmount}}</strong>
                          </div>

                            <table class="table borderless table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Fecha</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Nombre</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Remito</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Guia</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Localidad</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Provincia</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Datos Adicionales</th>
                                    @for ($i = 1; $i <= 15; $i++)
                                      @php 
                                        $serviceName = $columnsServices[0]->{'service' . $i}; 
                                        $value = $columnsServices[0]->{'price' . $i}; 
                                      @endphp
                                        @if( $value != null )
                                          <th scope="col" class="text" style="font-weight: bold; background: lightgray; max-width: 180px;">
                                            <input type="text" value="{{$serviceName}}" id="service{{$i}}" style="border: none; background-color: lightgray; color: black; font-weight: bold;" readonly="readonly">
                                            <br>
                                            <input type="text" value="{{$value}}" id="price{{$i}}" style="border: none; background-color: lightgray; color: black; font-weight: bold;" readonly="readonly">
                                          </th>
                                          @php $countColumns++; @endphp
                                        @endif
                                    @endfor
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Acción</th>
                                  </tr>
                                </thead>
                                <tbody id="table">
                                  @foreach($servicesRemitos as $key => $val)
                                    <tr>
                                        <th scope="col" class="text" style="font-weight: 500;">{{$val->fecha}}</th>
                                        <th scope="col" class="text" style="font-weight: 500;">{{$val->nombre}}</th>
                                        <th scope="col" class="text" style="font-weight: 500;">{{$val->remito}}</th>
                                        <th scope="col" class="text" style="font-weight: 500;">{{$val->guia}}</th>

                                        <th scope="col" class="text" style="font-weight: 500;">{{$val->localidad}}</th>
                                        <th scope="col" class="text" style="font-weight: 500;">{{$val->provincia}}</th>
                                        <th scope="col" class="text" style="font-weight: 500;">{{$val->adicionales}}</th>
                                        @for ($i = 1; $i <= 15; $i++)
                                          @php 
                                            $serviceName = $columnsServices[0]->{'service' . $i}; 
                                            $value = $columnsServices[0]->{'price' . $i}; 
                                          @endphp
                                            @if( $value != null )
                                              @if($val->counter == $i)
                                                <th scope="col" class="text" style="font-weight: 500;">
                                                  {{$val->quantity}} de ${{$val->price}} cu.
                                                  <input type="hidden" value="{{$val->quantity}}" class="colquantity{{$i}}">
                                                  <input type="hidden" value="{{($val->price * $val->quantity)}}" class="colammount{{$i}}">
                                                </th>
                                              @else
                                                <th style="font-weight: 500;"></th>
                                              @endif
                                              @php $countColumns = $i; @endphp
                                            @endif
                                        @endfor
                                        <th><button id="" type="button" class="btn btn-danger" onclick="delete_row('{{$val->id}}')">Borrar</button></th>
                                      </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th scope="col" class="text" style="font-weight: 500;"></th>
                                    <th scope="col" class="text" style="font-weight: 500;"></th>
                                    <th scope="col" class="text" style="font-weight: 500;"></th>

                                    <th scope="col" class="text" style="font-weight: 500;"></th>
                                    <th scope="col" class="text" style="font-weight: 500;"></th>
                                    <th scope="col" class="text" style="font-weight: 500;"></th>

                                    <th scope="col" class="text" style="font-weight: 500; color: red;">Cantidades Totales:</th>
                                    @for ($i = 1; $i <= 15; $i++)
                                      @php 
                                        $serviceName = $columnsServices[0]->{'service' . $i}; 
                                        $value = $columnsServices[0]->{'price' . $i}; 
                                      @endphp
                                          @if( $countColumns >= $i )
                                            <th scope="col" class="text cresult{{$i}}" style="font-weight: 500; color: red;">
                                              0
                                            </th>
                                            <script>
                                              var sumQtty = 0;
                                              $('.colquantity{{$i}}').each(function(){
                                                sumQtty += parseInt($(this).val());  // Or this.innerHTML, this.innerText
                                                console.log('Search: colquantity{{$i}} - Qtty: '+parseInt($(this).val()));
                                              });

                                              console.log('Suma cantidades: '+sumQtty);
                                              $('.cresult{{$i}}').html(sumQtty);
                                            </script>
                                          @endif
                                    @endfor
                                    <th></th>
                                  </tr>
                                  <tr>
                                    <th scope="col" class="text" style="font-weight: 500;"></th>
                                    <th scope="col" class="text" style="font-weight: 500;"></th>
                                    <th scope="col" class="text" style="font-weight: 500;"></th>

                                    <th scope="col" class="text" style="font-weight: 500;"></th>
                                    <th scope="col" class="text" style="font-weight: 500;"></th>
                                    <th scope="col" class="text" style="font-weight: 500;"></th>

                                    <th scope="col" class="text" style="font-weight: 500; color: red;">Montos Totales:</th>
                                    @for ($i = 1; $i <= 15; $i++)
                                      @php 
                                        $serviceName = $columnsServices[0]->{'service' . $i}; 
                                        $value = $columnsServices[0]->{'price' . $i}; 
                                      @endphp
                                        @if( $countColumns >= $i )
                                            <th scope="col" class="text cresultammount{{$i}}" style="font-weight: 500; color: red;">
                                              0
                                            </th>
                                            <script>
                                              var sumAmmount = 0;
                                              $('.colammount{{$i}}').each(function(){
                                                sumAmmount += parseInt($(this).val());  // Or this.innerHTML, this.innerText
                                              });

                                              $('.cresultammount{{$i}}').html('$ '+sumAmmount);
                                            </script>
                                        @endif
                                    @endfor
                                    <th></th>
                                  </tr>
                                </tfoot>

                            </table>

                            <input type="hidden" id="qtty" name="qtty" value="1">

                            <script>
                              function renderRow() {
                                  $('#qtty').val( parseInt($('#qtty').val()) + 1 );
                                  /* $( "#nuevoRemito" ).clone().attr('id', 'id'+ parseInt($('#qtty').val()) ).appendTo( "#container" ); */
                                  /* $('#nuevoRemito').clone().attr('id','asdasdasd3').appendTo('#container'); */

                                  var x = $("#nuevoRemito").clone();
                                  x.find('#fecha1').attr({id: "fecha"+parseInt($('#qtty').val())});
                                  x.find('#remito1').attr({id: "remito"+parseInt($('#qtty').val())});
                                  x.find('#nombre1').attr({id: "nombre"+parseInt($('#qtty').val())});
                                  x.find('#guia1').attr({id: "guia"+parseInt($('#qtty').val())});
                                  x.find('#localidad1').attr({id: "localidad"+parseInt($('#qtty').val())});
                                  x.find('#provincia1').attr({id: "provincia"+parseInt($('#qtty').val())});
                                  x.find('#adicionales1').attr({id: "adicionales"+parseInt($('#qtty').val())});
                                  x.find('#servicio1').attr({id: "servicio"+parseInt($('#qtty').val())});
                                  x.find('#cantidad1').attr({id: "cantidad"+parseInt($('#qtty').val())});

                                  x.appendTo('#container');

                              }
                            </script>

                            <div id="nuevoRemito" class="row pl-4">
                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Fecha</label>
                                    <input autocomplete="off" value="" onchange="$('#fechainput').val($(this).val())" type="input" class="form-control inputToClean datepicker2" 
                                    id="fecha1" aria-describedby="" placeholder="Fecha">
                                    <input type="hidden" id="fechainput">
                                </div>

                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Remito</label>
                                    <input type="input" class="form-control inputToClean" id="remito1" aria-describedby="" placeholder="Remito">
                                </div>

                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Nombre</label>
                                    <input type="input" class="form-control inputToClean" id="nombre1" aria-describedby="" placeholder="Nombre">
                                </div>

                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">N° Guía</label>
                                    <input type="input" class="form-control inputToClean" id="guia1" aria-describedby="" placeholder="Guia">
                                </div>

                                <!--  -->

                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Localidad</label>
                                    <input type="input" class="form-control inputToClean" id="localidad1" aria-describedby="" placeholder="Localidad">
                                </div>

                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Provincia</label>
                                    <input type="input" class="form-control inputToClean" id="provincia1" aria-describedby="" placeholder="Provincia">
                                </div>

                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Datos Adicionales</label>
                                    <input type="input" class="form-control inputToClean" id="adicionales1" aria-describedby="" placeholder="Datos Adicionales">
                                </div>

                                <!--  -->

                                <div id="selectoption" class="form-group  bmd-form-group">
                                    <label for="exampleFormControlInput1">Servicio</label>
                                    <select id="servicio1" class="js-example-basic-single form-control" name="state">
                                      <option value="">Servicio</option>
                                      @for ($i = 1; $i <= 25; $i++)
                                          @php 
                                            $serviceName = $columnsServices[0]->{'service' . $i}; 
                                            $value = $columnsServices[0]->{'price' . $i}; 
                                          @endphp
                                            @if( $value != null )
                                              <option value="{{$i}} - ${{$value}}">{{$serviceName}} - ${{$value}}</option>
                                              @php $countColumns++; @endphp
                                            @endif
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group bmd-form-group ml-5">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Cantidad</label>
                                    <input value="1" type="input" class="form-control inputToClean" id="cantidad1" aria-describedby="" placeholder="Cantidad">
                                </div>

                            </div>
                            
                            <div id="container"></div>
                            
                            <button id="" type="button" class="btn btn-success" onclick="save_row()">Agregar esto/s Remitos</button>

                            <button id="" type="button" class="btn btn-raised-primary" onclick="renderRow()">Agregar más remitos</button>

                            <script type="text/javascript">
                              /* API REST */
                              function save_row() {
                                var exito = 0;
                                var fallo = 0;
                                for (var i = 1; i <= parseInt($('#qtty').val()); i++) 
                                {
                                  /* alert('Remito #'+i); */
                                  /* alert($('#servicio'+i+' option:selected').val()); */
                                  $.ajax({
                                      url: '{{route("remitos.create")}}',
                                      type: 'GET',
                                      data: {
                                        nombre:                $('#nombre'+i).val(),
                                        fecha:                 $('#fecha'+i).val(),
                                        remito:                $('#remito'+i).val(),
                                        guia:                  $('#guia'+i).val(),
                                        servicio:              $('#servicio'+i+' option:selected').val(),
                                        cantidad:              $('#cantidad'+i).val(),
                                        client:                '{{$clientId}}',

                                        localidad:             $('#localidad'+i).val(),
                                        provincia:             $('#provincia'+i).val(),
                                        adicionales:           $('#adicionales'+i).val()
                                      },
                                      success: function(result) {
                                          /* alert(result); */
                                          if(result === 1){
                                            var exito = exito + 1;
                                          }else{
                                            var fallo = fallo + 1;
                                          }
                                      }
                                  });
                                }
                                
                                location.reload();
                              }
                              function delete_row(id) {
                                $.ajax({
                                    url: '{{route("remitos.destroy", 1)}}'.replace('1', id),
                                    type: 'DELETE',
                                    success: function(result) {
                                        alert('Borrado exitosamente.');
                                        location.reload();
                                    }
                                });
                              }
                          </script>

                          @endif

                      <script>
                        $( function() {
                          $( ".datepicker1" ).datepicker({ format: 'yyyy-mm-dd' });
                          $( ".datepicker2" ).datepicker({ format: 'dd/mm/yyyy' });
                        } );
                      </script>
                          
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </form>

@endsection