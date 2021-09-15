@extends('general')

@section('content')

<form></form>
      <div class="container my-lg">
          <h2 class="doc-section-title" id="title">Resumen Mensual<a class="section-link" href="#examples"></a><span class="border-bottom"></span></h2>
          <div class="doc-example">
              <div class="row">
                  <div class="col-md-12">
                      <form>
                          <script type="text/javascript">
                            function resumenRender() 
                            {
                              let url = "{{ route('resumenmonthly.render', ['day' => 22222]) }}".replace('22222', $('#fecha').val());
                                  window.location.href = url;
                            }

                            function modalFacturar(id, date)
                            {
                              var fecha = prompt("Fecha de Factura DD/MM/AAAA");
                              var numero = prompt("Tipo y Numero de Factura, ej: A 1001-000040");
                              var monto = prompt("Monto SIN decimales, ni simbolos, ejemplo: 50000 para $50.000");

                              $.ajax({
                                    url: '{{route("resumenmonthly.create")}}',
                                    type: 'GET',
                                    data: {
                                      date:                  date,
                                      id:                    id,
                                      fecha:                 fecha,
                                      numero:                numero,
                                      monto:                 monto
                                    },
                                    success: function(result) {
                                        if(result === '1'){
                                          alert('Creado exitosamente.');
                                          location.reload();
                                        }
                                    }
                                });

                            }

                          </script>

                          <div id="selectoption" class="form-group">
                              <label for="exampleFormControlInput1">Seleccione un Mes</label>
                              <i style="color: red;">Importante: El día no será considerado.</i>
                              <input onchange="resumenRender()" id="fecha" class="form-control datepicker1" type="text" value="@php 
                                if(isset($day)): echo $day; else: echo date('Y-m-d'); endif;
                              @endphp" placeholder="Mes">
                          </div>
                          <!-- Remitos management -->
                          
                          @if(isset($day))
                            <table class="table borderless table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Empresa</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Total</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Remitos</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Facturar</th>
                                  </tr>
                                </thead>
                                <tbody id="table">
                                  @php $totalGeneral = 0; @endphp
                                  @foreach($salesByClient as $id => $sale)
                                    <tr>
                                      <td>{{$sale["Name"]}}</td>
                                      <td>
                                        ${{$sale["Total"]}}
                                        @php $totalGeneral += $sale["Total"]; @endphp
                                      </td>
                                      <td>{{$sale["Remtios"]}}</td>
                                      <td>
                                        @if($sale["Billed"] > 0)
                                          <p style="color: green; font-weight: bold;">Ya fué facturado.</p>
                                        @else
                                          <button onclick="modalFacturar('{{$id}}', '{{$day}}')" type="button" class="btn btn-raised-primary" onclick="$">Facturar</button>
                                        @endif
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th scope="col" class="text" style="font-weight: 500;"></th>
                                    <th scope="col" class="text" style="font-weight: 500; color: red;">Total Cta Cte: ${{$totalGeneral}}</th>
                                    <th></th>
                                  </tr>
                                </tfoot>
                            </table>
                            <script type="text/javascript">
                              /* API REST */
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

      <script>
        function create_row_recibo(id) {
            var fecha = prompt("Fecha de Pago DD/MM/AAAA");
            var numero = prompt("Numero de Recibo, ej: 000040");
            var monto = prompt("Monto SIN decimales, ni simbolos, ejemplo: 50000 para $50.000");

            $.ajax({
                  url: '{{route("resumenmonthly.addrecibo")}}',
                  type: 'GET',
                  data: {
                    id:                    id,
                    fecha:                 fecha,
                    numero:                numero,
                    monto:                 monto
                  },
                  success: function(result) {
                      if(result === '1'){
                        alert('Creado exitosamente.');
                        location.reload();
                      }
                  }
              });
          }
      </script>

      <div class="container my-lg">
          <h2 class="doc-section-title" id="title">Cuentas Corrientes<a class="section-link" href="#examples"></a><span class="border-bottom"></span></h2>
          <div class="doc-example">
              <div class="row">
                  <div class="col-md-12">
                      @foreach($cc as $id => $data)
                        <h4 class="w-100">{{$id}} <button style="float: right; margin-right: 10px; margin-bottom: 10px !important;" id="create" type="button" class="btn btn-raised-primary" 
                          onclick="create_row_recibo('{{$data["id"]}}');">Dar de Alta Pago<div class="ripple-container"></div></button></h4>
                        <table class="table borderless table-hover">
                            <thead>
                              <tr>
                                <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Fecha</th>
                                <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Concepto</th>
                                <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Debe</th>
                                <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Haber</th>
                                <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Saldo</th>
                              </tr>
                            </thead>
                            <tbody id="table">
                              @php $ccBalance = 0; @endphp
                              @foreach($data['movements'] as $dataRow)
                                <tr>
                                  <td>{{$dataRow->date}}</td>
                                  

                                  @php
                                    if($dataRow->type == "debe"):
                                      $ccBalance += $dataRow->ammount;
                                      echo '<td>'.$dataRow->concept.'</td>';
                                      echo '<td>$ '.$dataRow->ammount.'</td>';
                                      echo '<td></td>';
                                    else:
                                      $ccBalance -= $dataRow->ammount;
                                      echo '<td>Pago Recibo '.$dataRow->concept.'</td>';
                                      echo '<td></td>';
                                      echo '<td>($ '.$dataRow->ammount.')</td>';
                                    endif;
                                  @endphp

                                  <td>$ {{$ccBalance}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                      @endforeach
                  </div>
              </div>
          </div>
      </div>
  </form>

@endsection