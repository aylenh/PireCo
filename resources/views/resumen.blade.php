@extends('general')

@section('content')

<form></form>
      <div class="container my-lg">
          <h2 class="doc-section-title" id="title">Resumen Diario<a class="section-link" href="#examples"></a><span class="border-bottom"></span></h2>
          <div class="doc-example">
              <div class="row">
                  <div class="col-md-12">
                      <form>
                          <script type="text/javascript">
                            function resumenRender() 
                            {
                              let url = "{{ route('resumen.render', ['day' => 22222]) }}".replace('22222', $('#fecha').val());
                                  window.location.href = url;
                            }
                          </script>

                          <div id="selectoption" class="form-group">
                              <label for="exampleFormControlInput1">Fecha</label>
                              <input onchange="resumenRender()" id="fecha" class="form-control datepicker1" type="text" value="@php 
                                if(isset($day)): echo $day; else: echo date('Y-m-d'); endif;
                              @endphp" placeholder="Fecha">
                          </div>
                          <!-- Remitos management -->
                          
                          @if(isset($day))
                            <table class="table borderless table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Empresa</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Total</th>
                                    <th scope="col" class="text" style="font-weight: bold; background: lightgray;">Remitos</th>
                                  </tr>
                                </thead>
                                <tbody id="table">
                                  @php $totalGeneral = 0; @endphp
                                  @foreach($salesByClient as $sale)
                                    <tr>
                                      <td>{{$sale["Name"]}}</td>
                                      <td>
                                        ${{$sale["Total"]}}
                                        @php $totalGeneral += $sale["Total"]; @endphp
                                      </td>
                                      <td>{{$sale["Remtios"]}}</td>
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
                              function save_row() {
                                $.ajax({
                                    url: '{{route("remitos.create")}}',
                                    type: 'GET',
                                    data: {
                                      fecha:                 $('#fecha').val(),
                                      remito:                $('#remito').val(),
                                      guia:                  $('#guia').val(),
                                      servicio:              $('#servicio').val(),
                                      cantidad:              $('#cantidad').val()
                                    },
                                    success: function(result) {
                                        if(result === '1'){
                                          alert('Creado exitosamente.');
                                          $('.inputToClean').val('');
                                          location.reload();
                                        }
                                    }
                                });
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