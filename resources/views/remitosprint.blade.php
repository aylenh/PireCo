@extends('general')

@section('content')

<form></form>
      <div class="container my-lg">
          <h2 class="doc-section-title" id="title">Impresión de Remitos<a class="section-link" href="#examples"></a><span class="border-bottom"></span></h2>
          <div class="doc-example" style="overflow: scroll;">
              <div class="row">
                  <div class="col-md-12">
                      <form>
                          <script type="text/javascript">
                            function remitosRender() 
                            {
                                if( $('#idCLient option:selected').val() )
                                {
                                  let url = "{{ route('remitosprint.render', ['client' => 1111111, 'day' => 22222, 'day2' => 33333]) }}"
                                  .replace('1111111', $('#idCLient option:selected').val())
                                  .replace('22222', $('#fecha').val())
                                  .replace('33333', $('#fecha2').val());
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
                              <label for="exampleFormControlInput1">Fecha Inicio</label>
                              <input onchange="remitosRender()" id="fecha" class="form-control datepicker1" type="text" value="@php 
                                if(isset($day)): echo $day; else: echo date('Y-m-d'); endif;
                              @endphp" placeholder="Fecha">
                          </div>

                          <div id="selectoption" class="form-group">
                              <label for="exampleFormControlInput1">Fecha Finalización</label>
                              <input onchange="remitosRender()" id="fecha2" class="form-control datepicker1" type="text" value="@php 
                                if(isset($day2)): echo $day2; else: echo date('Y-m-d'); endif;
                              @endphp" placeholder="Fecha">
                          </div>
                          <!-- Remitos management -->
                          
                          @if(isset($clientId))

                          <!-- <div class="alert alert-danger" role="alert">
                            Total de ventas en este mes: <strong style="font-size: 20px;">${{$finalAmmount}}</strong>
                          </div> -->

                            <script type="text/javascript">
                              function printdiv(printdivname) {
                                  var headstr = "<html><head><title>Booking Details</title></head><body>";
                                  var footstr = "</body>";
                                  var newstr = document.getElementById(printdivname).innerHTML;
                                  var oldstr = document.body.innerHTML;
                                  document.body.innerHTML = headstr+newstr+footstr;
                                  window.print();
                                  document.body.innerHTML = oldstr;
                                  return false;
                              }
                            </script>

                          <style type="text/css" media="print">
                            @page { size: landscape; }
                          </style>

                            <a class="btn btn-raised-primary mr-3" onclick="$('#tablacntnt').printThis({
                              importCSS: true,
    importStyle: true
                            });">Imprimir</a>

                            <div id="tablacntnt">
                              <div class="alert alert-danger" role="alert">
                                Total de ventas en este mes: $ <strong style="font-size: 20px;" id="genneralAmmount">0</strong>
                              </div>

                              <table id="tabla" class="table borderless table-hover">
                                  <thead>
                                    <tr style=" font-size: 10px;">
                                      <th scope="col" class="text" style="font-size: 10px;font-weight: bold; background: lightgray; padding: 0 0 0 0; margin: 0 0 0 0; ">Fecha</th>
                                      <th scope="col" class="text" style="font-size: 10px;font-weight: bold; background: lightgray; padding: 0 0 0 0; margin: 0 0 0 0; ">Nombre</th>
                                      <th scope="col" class="text" style="font-size: 10px;font-weight: bold; background: lightgray; padding: 0 0 0 0; margin: 0 0 0 0; ">Remito</th>
                                      <th scope="col" class="text" style="font-size: 10px;font-weight: bold; background: lightgray; padding: 0 0 0 0; margin: 0 0 0 0; ">Guia</th>
                                      <th scope="col" class="text" style="font-size: 10px;font-weight: bold; background: lightgray; padding: 0 0 0 0; margin: 0 0 0 0; ">Localidad</th>
                                      <th scope="col" class="text" style="font-size: 10px;font-weight: bold; background: lightgray; padding: 0 0 0 0; margin: 0 0 0 0; ">Provincia</th>
                                      <th scope="col" class="text" style="font-size: 10px;font-weight: bold; background: lightgray; padding: 0 0 0 0; margin: 0 0 0 0; ">Datos Adicionales</th>
                                      @for ($i = 1; $i <= 15; $i++)
                                        @php 
                                          $serviceName = $columnsServices[0]->{'service' . $i}; 
                                          $value = $columnsServices[0]->{'price' . $i}; 
                                        @endphp
                                          @if( $value != null )
                                            <th scope="col" class="text" style="font-weight: bold; background: lightgray; width: 50px; padding: 0 0 0 0; margin: 0 0 0 0; font-size: 10px;">
                                              <!-- <input type="text" value="{{$serviceName}}" id="service{{$i}}" style="border: none; background-color: lightgray; color: black; font-weight: bold;" readonly="readonly">
                                              <br> -->
                                              {{$value}}
                                              <input type="hidden" value="{{$value}}" id="price{{$i}}" style="border: none; background-color: lightgray; color: black; font-weight: bold;" readonly="readonly">
                                            </th>
                                            @php $countColumns++; @endphp
                                          @endif
                                      @endfor
                                    </tr>
                                  </thead>
                                  <tbody id="table">
                                    @foreach($servicesRemitos as $key => $val)
                                      <tr style=" font-size: 10px;">
                                          <th scope="col" class="text" style="font-weight: 500; padding: 0 0 0 0; margin: 0 0 0 0; ">{{$val->fecha}}</th>
                                          <th scope="col" class="text" style="font-weight: 500; padding: 0 0 0 0; margin: 0 0 0 0; ">{{$val->nombre}}</th>
                                          <th scope="col" class="text" style="font-weight: 500; padding: 0 0 0 0; margin: 0 0 0 0; ">{{$val->remito}}</th>
                                          <th scope="col" class="text" style="font-weight: 500; padding: 0 0 0 0; margin: 0 0 0 0; ">{{$val->guia}}</th>

                                          <th scope="col" class="text" style="font-weight: 500; padding: 0 0 0 0; margin: 0 0 0 0; ">{{$val->localidad}}</th>
                                          <th scope="col" class="text" style="font-weight: 500; padding: 0 0 0 0; margin: 0 0 0 0; ">{{$val->provincia}}</th>
                                          <th scope="col" class="text" style="font-weight: 500; padding: 0 0 0 0; margin: 0 0 0 0; ">{{$val->adicionales}}</th>
                                          @for ($i = 1; $i <= 15; $i++)
                                            @php 
                                              $serviceName = $columnsServices[0]->{'service' . $i}; 
                                              $value = $columnsServices[0]->{'price' . $i}; 
                                            @endphp
                                              @if( $value != null )
                                                @if($val->counter == $i)
                                                  <th scope="col" class="text" style="display: table-caption; max-width: 50px; font-weight: 500; padding: 0 0 0 0; margin: 0 0 0 0;">
                                                    {{$val->quantity}} de ${{$val->price}} cu.
                                                    <input type="hidden" value="{{$val->quantity}}" class="colquantity{{$i}}">
                                                    <input type="hidden" value="{{($val->price * $val->quantity)}}" class="colammount{{$i}}">
                                                  </th>
                                                @else
                                                  <th style="padding: 0 0 0 0; margin: 0 0 0 0; font-weight: 500;"></th>
                                                @endif
                                                @php $countColumns = $i; @endphp
                                              @endif
                                          @endfor
                                        </tr>
                                      @endforeach
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <th scope="col" class="text" style="padding: 0 0 0 0; margin: 0 0 0 0;font-weight: 500;"></th>
                                      <th scope="col" class="text" style="padding: 0 0 0 0; margin: 0 0 0 0;font-weight: 500;"></th>
                                      <th scope="col" class="text" style="padding: 0 0 0 0; margin: 0 0 0 0;font-weight: 500;"></th>

                                      <th scope="col" class="text" style="padding: 0 0 0 0; margin: 0 0 0 0;font-weight: 500;"></th>
                                      <th scope="col" class="text" style="padding: 0 0 0 0; margin: 0 0 0 0;font-weight: 500;"></th>
                                      <th scope="col" class="text" style="padding: 0 0 0 0; margin: 0 0 0 0;font-weight: 500;"></th>

                                      <th scope="col" class="text" style="padding: 0 0 0 0; margin: 0 0 0 0;font-weight: 500; color: red;">Cantidades Totales:</th>
                                      @for ($i = 1; $i <= 15; $i++)
                                        @php 
                                          $serviceName = $columnsServices[0]->{'service' . $i}; 
                                          $value = $columnsServices[0]->{'price' . $i}; 
                                        @endphp
                                            @if( $countColumns >= $i )
                                              <th scope="col" class="text cresult{{$i}}" style="padding: 0 0 0 0; margin: 0 0 0 0; font-weight: 500; color: red;">
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
                                      @php
                                        $generalAmmount = 0;
                                      @endphp
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

                                                $('#genneralAmmount').html(
                                                  parseInt($('#genneralAmmount').html()) + sumAmmount                                             
                                                );
                                              </script>
                                          @endif
                                      @endfor
                                      <th></th>
                                    </tr>
                                  </tfoot>

                              </table>
                            </div>

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