@extends('caja.general')

@section('content')

      <script>
        function create_income() {
            $.ajax({
                  url: '{{route("cash2.addincome")}}',
                  type: 'GET',
                  data: {
                    concept:                 $('#ingreso_tipo option:selected').val(),
                    ammount:                 $('#ingreso_cantidad').val(),
                    ingreso_mercadopago:     $('#ingreso_mercadopago').val(),
                    formadepagodigitalselector: $('#formadepagodigitalselector option:selected').val(),
                    lastAmmount:             $('#lastAmmount').val(),
                    ingresos_observaciones:    $('#ingresos_observaciones').val(),
                    monto:                   $('#monto').val()
                  },
                  success: function(result) {
                      if(result === '1'){
                        alert('Guarado exitosamente.');
                        location.reload();
                      }
                  }
              });
          }

          function create_outcome() {
            $.ajax({
                  url: '{{route("cash2.addoutcome")}}',
                  type: 'GET',
                  data: {
                    concept:                 $('#egreso_tipo option:selected').val(),
                    ammount:                 $('#egreso_monto').val(),
                    egreso_observaciones:    $('#egreso_observaciones').val(),
                    lastAmmount:             $('#lastAmmount').val()
                  },
                  success: function(result) {
                      if(result === '1'){
                        alert('Guarado exitosamente.');
                        location.reload();
                      }
                  }
              });
          }
      </script>

      <div class="container my-lg">
          <h2 class="doc-section-title" id="title">Caja Operador <a class="section-link" href="#examples"></a><span class="border-bottom"></span></h2>
          <div class="doc-example">
              <div class="row">

                  <script type="text/javascript">
                    function resumenRender(date) 
                    {
                      let url = "{{ route('cash2.render', ['day' => 22222]) }}".replace('22222', date);
                          window.location.href = url;
                    }

                    function closeDay() 
                    {
                      var excedente = prompt("Aqueo: ¿Hay saldo a favor (excedente)? Especifique el monto, sin decimales, sin separador de miles y sin signo de $, caso contrario deje el campo vacio");
                      if(excedente == "") 
                      {
                        var faltante = prompt("Aqueo: ¿Hay saldo en contra (faltante)? Especifique el monto, sin decimales, sin separador de miles y sin signo de $, caso contrario deje el campo vacio");
                        if(faltante != "") 
                        {
                          /* Guardar faltante */
                          $.ajax({
                            url: '{{route("cash2.addoutcome")}}',
                            type: 'GET',
                            data: {
                              concept:                 'Cierre y Ajuste de Caja',
                              ammount:                 faltante,
                              ingreso_mercadopago:     '',
                              lastAmmount:             $('#lastAmmount').val()
                            },
                            success: function(result) {
                                if(result === '1'){
                                  alert('Guarado exitosamente.');
                                  location.reload();
                                }
                            }
                          });
                        }else{
                          /* Guardar SIN FALTANTES */
                          $.ajax({
                            url: '{{route("cash2.addoutcome")}}',
                            type: 'GET',
                            data: {
                              concept:                 'Cierre y Ajuste de Caja (Sin Faltantes)',
                              ammount:                 0,
                              ingreso_mercadopago:     '',
                              lastAmmount:             $('#lastAmmount').val()
                            },
                            success: function(result) {
                                if(result === '1'){
                                  alert('Guarado exitosamente.');
                                  location.reload();
                                }
                            }
                          });
                        }
                      }else{
                        /* Guardar excedente */
                        $.ajax({
                            url: '{{route("cash2.addincome")}}',
                            type: 'GET',
                            data: {
                              concept:                 'Cierre y Ajuste de Caja',
                              ammount:                 excedente,
                              ingreso_mercadopago:     '',
                              lastAmmount:             $('#lastAmmount').val()
                            },
                            success: function(result) {
                                if(result === '1'){
                                  alert('Guarado exitosamente.');
                                  location.reload();
                                }
                            }
                        });
                      }
                      
                    }

                  </script>

                  
                  <button style="height: fit-content; margin-top: 20px; margin-left: 20px;" type="button" class="btn btn-raised-primary mr-3" onclick="resumenRender('{{date('Y-m-d')}}');">Hoy</button>
                  <div id="selectoption" class="form-group" style="padding-left: 20px;">
                      <label for="exampleFormControlInput1">Fecha</label>
                      <input onchange="resumenRender($('#fecha').val())" id="fecha" class="form-control datepicker1" type="text" value="@php 
                        if(isset($day)): echo $day; else: echo date('Y-m-d'); endif;
                      @endphp" placeholder="Fecha">
                  </div>
                  

                  @if(!$mainview)
                
                      @if($day == date('Y-m-d'))
                        <!-- Cargar un Ingreso -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ingreso">
                          Cargar un Ingreso
                        </button>
                        <div class="modal fade" id="ingreso" tabindex="-1" role="dialog" aria-labelledby="ingresoLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document" style="top: 200px;">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="ingresoLabel">Cargar Ingreso</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <script>
                                  function fillPrice(servicio) {
                                    /* alert(servicio); */
                                    var dataService = servicio.split('- $');
                                    $('#monto').val(dataService[1]);
                                  }
                                </script>

                                <div id="ingreso_tipo" class="form-group  bmd-form-group">
                                    <label for="exampleFormControlInput1">Ingreso</label>
                                    <select id="servicio" onchange="fillPrice($(this).val())" class="js-example-basic-single form-control" name="state">
                                      <option value="">Ingreso</option>
                                      @for ($i = 1; $i <= 20; $i++)
                                          @php 
                                            $serviceName = $incomes[0]->{'service' . $i}; 
                                            $value = $incomes[0]->{'price' . $i}; 
                                          @endphp
                                            @if( $value != null )
                                              <option value="{{$serviceName}} - ${{$value}}">{{$serviceName}} - ${{$value}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Cantidad</label>
                                    <input type="input" class="form-control" id="ingreso_cantidad" aria-describedby="emailHelp" placeholder="Ej: 3" value="1">
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Monto</label>
                                    <input type="input" class="form-control" id="monto" aria-describedby="emailHelp" placeholder="Monto" value="">
                                </div>
                                <div class="form-group bmd-form-group">
                                    <input onclick="$('#formadepagodigital').removeClass('d-none');" type="checkbox" id="ingreso_mercadopago" value="1"> <label for="cbox2"> Pago Digital</label>
                                </div>

                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Observaciones</label>
                                    <input type="input" class="form-control" id="ingresos_observaciones" aria-describedby="emailHelp" placeholder="Observaciones">
                                </div>

                                <div id="formadepagodigital" class="form-group bmd-form-group d-none">
                                  <label for="exampleFormControlInput1">Medio de Pago Digital</label>
                                    <select id="formadepagodigitalselector" class="js-example-basic-single form-control" name="state">
                                      <option value="">Seleccione...</option>
                                      <option value="MercadoPago">MercadoPago</option>
                                    </select>
                                </div>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" onclick="create_income()">Guardar Ingreso</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Cargar un Egreso -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#egreso">
                          Cargar un Egreso
                        </button>
                        <div class="modal fade" id="egreso" tabindex="-1" role="dialog" aria-labelledby="egresoLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document" style="top: 200px;">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="egresoLabel">Cargar Egreso</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div id="selectoption" class="form-group  bmd-form-group">
                                    <label for="exampleFormControlInput1">Egreso</label>
                                    <select id="egreso_tipo" class="js-example-basic-single form-control" name="state">
                                      <option value="">Egreso</option>
                                      @for ($i = 1; $i <= 20; $i++)
                                          @php 
                                            $serviceName = $outcomes[0]->{'service' . $i}; 
                                          @endphp
                                          @if(null !== $serviceName)
                                            <option value="{{$serviceName}}">{{$serviceName}}</option>
                                          @endif
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Monto (sin $, ni decimales ni separador de miles)</label>
                                    <input type="input" class="form-control" id="egreso_monto" aria-describedby="emailHelp" placeholder="Ej: 300">
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Observaciones</label>
                                    <input type="input" class="form-control" id="egreso_observaciones" aria-describedby="emailHelp" placeholder="Observaciones">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" onclick="create_outcome()">Guardar Egreso</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      @else
                        <p style="color: red;" class="mr-5">Estás viendo un dia previo,<br>no puedes cargar movimientos en dias previos,<br>solo puedes cerrarlos.</p>
                      @endif

                      <!-- Efectuar Cierre -->
                      @if($day == date('Y-m-d') && $countClose == 0  && $countClosesAfterToday == 0 || $day < date('Y-m-d') && $countCloseThisDay == 0 && $countClosesAfterToday == 0 )
                        @if(session('profiletype')=="1")
                          <button type="button" class="btn btn-danger" onclick="closeDay();">
                            Cerrar el Día (No Reversible)
                          </button>
                        @endif
                      @endif

                    @if(session('profiletype')=="1")
                      <div class="col-md-12">
                            <table class="table borderless table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">MovID</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Concepto</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Debe</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Haber</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Forma de Pago</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Saldo</th>
                                  </tr>
                                </thead>
                                <tbody id="tableCash">
                                    @php $cash = 0; @endphp
                                    <tr @php if($prevC->concept == 'Cierre y Ajuste de Caja ()' || $prevC->concept == 'Cierre y Ajuste de Caja'): echo 'style="background: lightgray;"'; endif; @endphp>
                                      <td>{{$prevC->id}}</td>
                                      <td>{{$prevC->concept}} <strong>PREVIO</strong></td>
                                      @if($prevC->type == 'debe')
                                        <td>$ {{$prevC->result}}</td>
                                        @php $cash = $prevC->result; @endphp
                                        <td></td>
                                      @else
                                        <td></td>
                                        <td>$ {{$prevC->result}}</td>
                                        @php $cash = $prevC->result; @endphp
                                      @endif
                                      <td></td>
                                      <td>$ {{$cash}}</td>
                                    </tr>
                                    @foreach($movements as $movD)
                                      <tr @php if($movD->concept == 'Cierre y Ajuste de Caja ()' || $movD->concept == 'Cierre y Ajuste de Caja' || $movD->concept == 'Cierre y Ajuste de Caja (Sin Faltantes) ()'): echo 'style="background: red; color: white;"'; endif; @endphp>
                                        <td>{{$movD->id}}</td>
                                        <td>{{$movD->concept}}</td>
                                        @if($movD->type == 'debe')
                                          <td>$ {{$movD->finalammout}}</td>
                                          @php $cash -= $movD->finalammout; @endphp
                                          <td></td>
                                        @else
                                          <td></td>
                                          <td>$ {{$movD->finalammout}}</td>
                                          @php 
                                            if($movD->paymentmethod == 'Efectivo'):
                                              $cash += $movD->finalammout; 
                                            endif;
                                          @endphp
                                        @endif
                                        <td>{{$movD->paymentmethod}}</td>
                                        <td>$ {{$cash}}</td>
                                      </tr>
                                    @endforeach
                                </tbody>

                                <input type="hidden" id="lastAmmount" value="{{$cash}}">
                            </table>
                      </div>
                    @endif

                  @endif

                  @if(session('profiletype')=="1")
                    <hr style="border-top: 1px solid lightgray; width: 100%;">

                    <div class="row w-100">
                      <div class="col-4">
                        <h4>Ingresos</h4>
                        @if(isset($incomesResume))
                        <table class="table borderless table-hover" style="max-width: 350px;">
                            <thead>
                              <tr>
                                <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Concepto</th>
                                <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Monto Total</th>
                              </tr>
                            </thead>
                            <tbody id="tableCash">
                              @foreach($incomesResume as $iR)
                                <tr>
                                  <td>{{$iR->concept}}</td>
                                  <td>$ {{$iR->Suma}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                        @endif
                      </div>
                      <div class="col-4">
                        <h4>Egresos</h4>
                        @if(isset($outcomesResume))
                        <table class="table borderless table-hover" style="max-width: 350px;">
                            <thead>
                              <tr>
                                <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Concepto</th>
                                <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Monto Total</th>
                              </tr>
                            </thead>
                            <tbody id="tableCash">
                              @foreach($outcomesResume as $oR)
                                <tr>
                                  <td>{{$oR->concept}}</td>
                                  <td>$ {{$oR->Suma}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                        @endif
                      </div>
                      <div class="col-4">
                        <h4>Pago Digital</h4>
                        @if(isset($mpResume))
                        <table class="table borderless table-hover" style="max-width: 350px;">
                            <thead>
                              <tr>
                                <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Forma de Pago</th>
                                <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Monto Total</th>
                              </tr>
                            </thead>
                            <tbody id="tableCash">
                              @foreach($mpResume as $mp)
                                <tr>
                                  <td>{{$mp->paymentmethod}}</td>
                                  <td>$ {{$mp->Suma}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                        @endif
                      </div>
                    </div>
                  @else
                    <div class="alert alert-danger" role="alert">
                      No puedes ver los movimientos de caja ya que estás con un usuario limitado. Si necesitás mas información, contactá a un administrador.
                    </div>
                  @endif

                  @if(session('profiletype')=="1")
                    <hr style="border-top: 1px solid lightgray; width: 100%;">

                    @if(isset($incomesResumeMonthly) && isset($outcomesResumeMonthly))
                      <div class="row w-100">
                        <div class="col-6">
                          <h4>Balance del Mes Corriente (Unicamente de esta Caja)</h4>
                          <table class="table borderless table-hover" style="max-width: 350px;">
                              <thead>
                                <tr>
                                  <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Ingresos</th>
                                  <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Egresos</th>
                                  <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Resultado</th>
                                </tr>
                              </thead>
                              <tbody id="tableCash">
                                  <tr>
                                    <td>$ {{$incomesResumeMonthly[0]->Suma}}</td>
                                    <td>$ {{$outcomesResumeMonthly[0]->Suma}}</td>
                                    <td>$ 
                                      @php
                                              echo $incomesResumeMonthly[0]->Suma - $outcomesResumeMonthly[0]->Suma;
                                      @endphp
                                    </td>
                                  </tr>
                              </tbody>
                          </table>

                          <ul>
                            <li>Los pagos digitales también son considerados en estos montos.</li>
                            <li>Automáticamente, al cambiar de mes y pasar a ser 01 del nuevo mes, estos valores se reiniciarán a cero sin acción alguna. Asegúrate de el ultimo dia de cada mes ver este balance.</li>
                            <li>Si estás consultando este balance ANTES de que termine el mes, estás viendo la imagen de este mismo dia. La cual irá mutando a medida que el mes continue.</li>
                          </ul>
                        </div>
                      </div>
                    @endif
                  @endif


              </div>
          </div>
      </div>
  </form>

  <script>
    $( function() {
      $( ".datepicker1" ).datepicker({ format: 'yyyy-mm-dd' });
      $( ".datepicker2" ).datepicker({ format: 'dd/mm/yyyy' });
    } );
  </script>

@endsection