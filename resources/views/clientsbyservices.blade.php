@extends('general')

@section('content')

<form>
      <div class="container my-lg">
          <h2 class="doc-section-title" id="title">Crear Servicios a Clientes<a class="section-link" href="#examples"></a><span class="border-bottom"></span></h2>
          <div class="doc-example">
              <div class="row">
                  <div class="col-md-6">
                      <form>
                          <div id="selectoption" class="form-group">
                            <label for="exampleFormControlInput1">Cliente</label>
                            <select id="idCLient" class="js-example-basic-single" name="state">
                              <option value="">Seleccione un cliente...</option>
                              @foreach($clientes as $client)
                                <option value="{{$client->id}}">{{$client->rsocial}}</option>
                              @endforeach
                            </select>
                          </div>
                          @for ($i = 1; $i <= 25; $i++)
                              <div class="form-group bmd-form-group">
                                  <label for="exampleInputEmail1" class="bmd-label-static">Nombre del Servicio {{$i}}</label>
                                  <input type="input" class="form-control inputToClean" id="service{{$i}}" aria-describedby="" placeholder="Nombre del Servicio {{$i}}">
                              </div>
                              <div class="form-group bmd-form-group">
                                  <label for="exampleInputEmail1" class="bmd-label-static">Costo del Servicio {{$i}}</label>
                                  <input type="input" class="form-control inputToClean" id="price{{$i}}" aria-describedby="" placeholder="Costo del Servicio {{$i}}">
                              </div>
                          @endfor
                          <br>
                          <button id="create" type="button" class="btn btn-raised-primary" onclick="create_row();">Crear Servicios a Clientes</button>
                          <button id="edit" type="button" class="btn btn-raised-warning d-none" onclick="edit_row();">Editar Servicios de Clientes</button>
                          <button id="cancelEdit" type="button" class="btn btn-primary d-none" onclick="rollbackEditMode();">Cancelar Edición</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </form>

  <div class="card table-responsive">
      <table class="table borderless table-hover">
        <thead>
          <tr>
            <th scope="col" class="text">Nombre</th>
            <th scope="col" class="text-muted">Acciones</th>
          </tr>
        </thead>
        <tbody id="table">
        </tbody>
      </table>
    </div>

  <script type="text/javascript">

    $(document).ready( show );

    function renderEdit(id) {
      alert('Edite en el formulario de arriba, y confirme');
      $('#title').html('Editar Cliente');
      $('#create').addClass('d-none');
      $('#edit, #cancelEdit').removeClass('d-none');

      $.ajax({
          url: '{{route("clientsbyservices.show", 1)}}',
          type: 'GET',
          success: function(result) {
            result.forEach( function(valor, indice, array) {
                if(valor.id == id) {
                  
                  $('#idCLient option[value='+valor.idCLient+']').attr('selected','selected');

                  $('#service1').val(valor.service1);
                  $('#price1').val(valor.price1);

                  $('#service2').val(valor.service2);
                  $('#price2').val(valor.price2);

                  $('#service3').val(valor.service3);
                  $('#price3').val(valor.price3);

                  $('#service4').val(valor.service4);
                  $('#price4').val(valor.price4);

                  $('#service5').val(valor.service5);
                  $('#price5').val(valor.price5);

                  $('#service6').val(valor.service6);
                  $('#price6').val(valor.price6);

                  $('#service7').val(valor.service7);
                  $('#price7').val(valor.price7);

                  $('#service8').val(valor.service8);
                  $('#price8').val(valor.price8);

                  $('#service9').val(valor.service9);
                  $('#price9').val(valor.price9);

                  $('#service10').val(valor.service10);
                  $('#price10').val(valor.price10);

                  $('#service11').val(valor.service11);
                  $('#price11').val(valor.price11);

                  $('#service12').val(valor.service12);
                  $('#price12').val(valor.price12);

                  $('#service13').val(valor.service13);
                  $('#price13').val(valor.price13);

                  $('#service14').val(valor.service14);
                  $('#price14').val(valor.price14);

                  $('#service15').val(valor.service15);
                  $('#price15').val(valor.price15);

                  /*  */

                  $('#service16').val(valor.service16);
                  $('#price16').val(valor.price16);

                  $('#service17').val(valor.service17);
                  $('#price17').val(valor.price17);

                  $('#service18').val(valor.service18);
                  $('#price18').val(valor.price18);

                  $('#service19').val(valor.service19);
                  $('#price19').val(valor.price19);

                  $('#service20').val(valor.service20);
                  $('#price20').val(valor.price20);

                  $('#service21').val(valor.service21);
                  $('#price21').val(valor.price21);

                  $('#service22').val(valor.service22);
                  $('#price22').val(valor.price22);

                  $('#service23').val(valor.service23);
                  $('#price23').val(valor.price23);

                  $('#service24').val(valor.service24);
                  $('#price24').val(valor.price24);
                  
                  $('#service25').val(valor.service25);
                  $('#price25').val(valor.price25);

                }
            });
          }
      });

      localStorage.setItem('editing', id);
    }
    function rollbackEditMode() {
      $('#title').html('Crear Usuario');
      $('#create').removeClass('d-none');
      $('#edit, #cancelEdit').addClass('d-none');
      $('.inputToClean').val('');
      $('#idCLient option[value=""]').attr('selected','selected');
      localStorage.removeItem('editing');
    }

    /* API REST */
    function show(){
      $('#table').html('');
      $.ajax({
          url: '{{route("clientsbyservices.show", 1)}}',
          type: 'GET',
          success: function(result) {
            result.forEach( function(valor, indice, array) {

              if(valor.profiletype == 1){
                var profileString = 'Perfil General';
              }

                $('#table').append('\
                  <tr>\
                      <th scope="row" class="align-middle">\
                          <span id="string_' +valor.id+ '" class="font-weight-semi">' +valor.rsocial+ '</span>\
                      </th>\
                      <td class="align-middle">\
                          <button onclick="renderEdit(\'' +valor.id+ '\')" type="button" class="btn btn-raised btn-raised-warning">Editar</button>\
                          <button onclick="delete_row(\'' +valor.id+ '\')" type="button" class="btn btn-danger">Borrar</button>\
                      </td>\
                  </tr>\
                ');
            });
          }
      });
    }
    function create_row() {
      $.ajax({
          url: '{{route("clientsbyservices.create")}}',
          type: 'GET',
          data: {
            idCLient:              $('#idCLient').val(),

            service1:              $('#service1').val(),
            price1:                $('#price1').val(),

            service2:              $('#service2').val(),
            price2:                $('#price2').val(),

            service3:              $('#service3').val(),
            price3:                $('#price3').val(),

            service4:              $('#service4').val(),
            price4:                $('#price4').val(),

            service5:              $('#service5').val(),
            price5:                $('#price5').val(),

            service6:              $('#service6').val(),
            price6:                $('#price6').val(),

            service7:              $('#service7').val(),
            price7:                $('#price7').val(),

            service8:              $('#service8').val(),
            price8:                $('#price8').val(),

            service9:              $('#service9').val(),
            price9:                $('#price9').val(),

            service10:              $('#service10').val(),
            price10:                $('#price10').val(),

            service11:              $('#service11').val(),
            price11:                $('#price11').val(),

            service12:              $('#service12').val(),
            price12:                $('#price12').val(),

            service13:              $('#service13').val(),
            price13:                $('#price13').val(),

            service14:              $('#service14').val(),
            price14:                $('#price14').val(),

            service15:              $('#service15').val(),
            price15:                $('#price15').val(),

            /*  */

            service16:              $('#service16').val(),
            price16:                $('#price16').val(),

            service17:              $('#service17').val(),
            price17:                $('#price17').val(),

            service18:              $('#service18').val(),
            price18:                $('#price18').val(),

            service19:              $('#service19').val(),
            price19:                $('#price19').val(),

            service20:              $('#service20').val(),
            price20:                $('#price20').val(),

            service21:              $('#service21').val(),
            price21:                $('#price21').val(),

            service22:              $('#service22').val(),
            price22:                $('#price22').val(),

            service23:              $('#service23').val(),
            price23:                $('#price23').val(),

            service24:              $('#service24').val(),
            price24:                $('#price24').val(),

            service25:              $('#service25').val(),
            price25:                $('#price25').val()

          },
          success: function(result) {
              if(result === '1'){
                alert('Creado exitosamente.');
                $('.inputToClean').val('');
                show();
              }
          }
      });
    }
    function delete_row(id) {
      $.ajax({
          url: '{{route("clientsbyservices.destroy", 1)}}'.replace('1', id),
          type: 'DELETE',
          success: function(result) {
              alert('Borrado exitosamente.');
              show();
          }
      });
    }
    function edit_row(){
      $.ajax({
        url: '{{route("clientsbyservices.edit", 1)}}'.replace('1', localStorage.getItem('editing')),
          type: 'GET',
          data: {
            idCLient:              $('#idCLient').val(),

            service1:              $('#service1').val(),
            price1:                $('#price1').val(),

            service2:              $('#service2').val(),
            price2:                $('#price2').val(),

            service3:              $('#service3').val(),
            price3:                $('#price3').val(),

            service4:              $('#service4').val(),
            price4:                $('#price4').val(),

            service5:              $('#service5').val(),
            price5:                $('#price5').val(),

            service6:              $('#service6').val(),
            price6:                $('#price6').val(),

            service7:              $('#service7').val(),
            price7:                $('#price7').val(),

            service8:              $('#service8').val(),
            price8:                $('#price8').val(),

            service9:              $('#service9').val(),
            price9:                $('#price9').val(),

            service10:              $('#service10').val(),
            price10:                $('#price10').val(),

            service11:              $('#service11').val(),
            price11:                $('#price11').val(),

            service12:              $('#service12').val(),
            price12:                $('#price12').val(),

            service13:              $('#service13').val(),
            price13:                $('#price13').val(),

            service14:              $('#service14').val(),
            price14:                $('#price14').val(),

            service15:              $('#service15').val(),
            price15:                $('#price15').val(),

            /*  */

            service16:              $('#service16').val(),
            price16:                $('#price16').val(),

            service17:              $('#service17').val(),
            price17:                $('#price17').val(),

            service18:              $('#service18').val(),
            price18:                $('#price18').val(),

            service19:              $('#service19').val(),
            price19:                $('#price19').val(),

            service20:              $('#service20').val(),
            price20:                $('#price20').val(),

            service21:              $('#service21').val(),
            price21:                $('#price21').val(),

            service22:              $('#service22').val(),
            price22:                $('#price22').val(),

            service23:              $('#service23').val(),
            price23:                $('#price23').val(),

            service24:              $('#service24').val(),
            price24:                $('#price24').val(),

            service25:              $('#service25').val(),
            price25:                $('#price25').val()

          },
          success: function(result) {
              if(result === '1'){
                alert('Editado exitosamente.');
                $('.inputToClean').val('');
                show();
                rollbackEditMode();
              }
          }
      });

    }
  </script>

@endsection