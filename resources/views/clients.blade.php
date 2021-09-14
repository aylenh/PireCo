@extends('general')

@section('content')

<form>
      <div class="container my-lg">
          <h2 class="doc-section-title" id="title">Crear Cliente<a class="section-link" href="#examples"></a><span class="border-bottom"></span></h2>
          <div class="doc-example">
              <div class="row">
                  <div class="col-md-6">
                      <form>
                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">Razón Social</label>
                              <input type="input" class="form-control inputToClean" id="rsocial" aria-describedby="" placeholder="Razón Social">
                          </div>

                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">Nombre de Fantasía</label>
                              <input type="input" class="form-control inputToClean" id="nfanstasia" aria-describedby="" placeholder="Nombre de Fantasía">
                          </div>

                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">Domicilio Fiscal</label>
                              <input type="input" class="form-control inputToClean" id="domicilif" aria-describedby="" placeholder="Domicilio Fiscal">
                          </div>

                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">CUIT</label>
                              <input type="input" class="form-control inputToClean" id="cuit" aria-describedby="" placeholder="CUIT">
                          </div>

                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">Categoria Fiscal</label>
                              <input type="input" class="form-control inputToClean" id="categoria" aria-describedby="" placeholder="Categoria Fiscal">
                          </div>

                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">Tipo de Factura</label>
                              <input type="input" class="form-control inputToClean" id="tipofactura" aria-describedby="" placeholder="Tipo de Factura">
                          </div>

                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">Facturar con</label>
                              <input type="input" class="form-control inputToClean" id="facturarcon" aria-describedby="" placeholder="Facturar con">
                          </div>

                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">Contacto</label>
                              <input type="input" class="form-control inputToClean" id="contacto" aria-describedby="" placeholder="Contacto">
                          </div>

                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">Domicilio de Retiro</label>
                              <input type="input" class="form-control inputToClean" id="domicilioretiro" aria-describedby="" placeholder="Domicilio de Retiro">
                          </div>

                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">Telefonos</label>
                              <input type="input" class="form-control inputToClean" id="telefonos" aria-describedby="" placeholder="Telefonos">
                          </div>

                          <div class="alert alert-warning" role="alert">
                                Importante! En caso de definir un email se enviará automáticamente de Lunes a Viernes un correo, a última hora resumiendo los servicios consumidos. En caso de no querer esta funcionalidad, deje el email vacio.
                              </div>

                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">Mail</label>
                              <input type="input" class="form-control inputToClean" id="mail" aria-describedby="" placeholder="Mail">
                          </div>

                          <div class="form-group bmd-form-group">
                              <label for="exampleInputEmail1" class="bmd-label-static">Observaciones</label>
                              <input type="input" class="form-control inputToClean" id="observaciones" aria-describedby="" placeholder="Observaciones">
                          </div>
                          <br>
                          <button id="create" type="button" class="btn btn-raised-primary" onclick="create_row();">Crear Cliente</button>
                          <button id="edit" type="button" class="btn btn-raised-warning d-none" onclick="edit_row();">Editar Cliente</button>
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
            <th scope="col" class="text">Telefono</th>
            <th scope="col" class="text">Email</th>
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
          url: '{{route("clients.show", 1)}}',
          type: 'GET',
          success: function(result) {
            result.forEach( function(valor, indice, array) {
                if(valor.id == id) {
                  $('#rsocial').val(valor.rsocial);
                  $('#nfanstasia').val(valor.nfanstasia);
                  $('#domicilif').val(valor.domicilif);
                  $('#cuit').val(valor.cuit);
                  $('#categoria').val(valor.categoria);
                  $('#tipofactura').val(valor.tipofactura);
                  $('#facturarcon').val(valor.facturarcon);
                  $('#contacto').val(valor.contacto);
                  $('#domicilioretiro').val(valor.domicilioretiro);
                  $('#telefonos').val(valor.telefonos);
                  $('#mail').val(valor.mail);
                  $('#observaciones').val(valor.observaciones);
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
      localStorage.removeItem('editing');
    }

    /* API REST */
    function show(){
      $('#table').html('');
      $.ajax({
          url: '{{route("clients.show", 1)}}',
          type: 'GET',
          success: function(result) {
            result.forEach( function(valor, indice, array) {

              if(valor.profiletype == 1){
                var profileString = 'Perfil General';
              }

                $('#table').append('\
                  <tr>\
                      <th scope="row" class="align-middle">\
                          <span id="string_' +valor.id+ '" class="font-weight-semi">' +valor.nfanstasia+ '</span>\
                      </th>\
                      <th scope="row" class="align-middle">\
                          <span id="string2_' +valor.id+ '" class="font-weight-semi">' +valor.telefonos+ '</span>\
                      </th>\
                      <th scope="row" class="align-middle">\
                          <span id="string2_' +valor.id+ '" class="font-weight-semi">' +valor.mail+ '</span>\
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
          url: '{{route("clients.create")}}',
          type: 'GET',
          data: {
            rsocial:              $('#rsocial').val(),
            nfanstasia:           $('#nfanstasia').val(),
            domicilif:            $('#domicilif').val(),
            cuit:                 $('#cuit').val(),
            categoria:            $('#categoria').val(),
            tipofactura:          $('#tipofactura').val(),
            facturarcon:          $('#facturarcon').val(),
            contacto:             $('#contacto').val(),
            domicilioretiro:      $('#domicilioretiro').val(),
            telefonos:            $('#telefonos').val(),
            mail:                 $('#mail').val(),
            observaciones:        $('#observaciones').val()
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
          url: '{{route("clients.destroy", 1)}}'.replace('1', id),
          type: 'DELETE',
          success: function(result) {
              alert('Borrado exitosamente.');
              show();
          }
      });
    }
    function edit_row(){
      $.ajax({
        url: '{{route("clients.edit", 1)}}'.replace('1', localStorage.getItem('editing')),
          type: 'GET',
          data: {
            rsocial:              $('#rsocial').val(),
            nfanstasia:           $('#nfanstasia').val(),
            domicilif:            $('#domicilif').val(),
            cuit:                 $('#cuit').val(),
            categoria:            $('#categoria').val(),
            tipofactura:          $('#tipofactura').val(),
            facturarcon:          $('#facturarcon').val(),
            contacto:             $('#contacto').val(),
            domicilioretiro:      $('#domicilioretiro').val(),
            telefonos:            $('#telefonos').val(),
            mail:                 $('#mail').val(),
            observaciones:        $('#observaciones').val()
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