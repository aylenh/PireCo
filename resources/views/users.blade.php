@extends('general')

@section('content')

        @if(session('superadmin'))

          <form>
              <div class="container my-lg">
                  <h2 class="doc-section-title" id="title">Crear Usuario<a class="section-link" href="#examples"></a><span class="border-bottom"></span></h2>
                  <div class="doc-example">
                      <div class="row">
                          <div class="col-md-6">
                              <form>
                                  <div class="form-group bmd-form-group">
                                      <label for="exampleInputEmail1" class="bmd-label-static">Nombre del Usuario</label>
                                      <input type="input" class="form-control" id="user" aria-describedby="emailHelp" placeholder="Usuario">
                                  </div>
                                  <div class="form-group bmd-form-group">
                                      <label for="exampleInputEmail1" class="bmd-label-static">Contraseña</label>
                                      <input type="input" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Contraseña">
                                  </div>
                                  <div class="form-group bmd-form-group">
                                      <label for="exampleInputEmail1" class="bmd-label-static">Tipo de Perfil</label>
                                      <select id="profiletype" id="" class="form-control">
                                          <option value="1">Perfil General</option>
                                          <!-- <option value="2">Seguridad Administrador</option>
                                          <option value="3">Seguridad Solo Lectura</option> -->
                                      </select>
                                  </div>
                                  <br>
                                  <button id="create" type="button" class="btn btn-raised-primary" onclick="create_row();">Crear Usuario</button>
                                  <button id="edit" type="button" class="btn btn-raised-warning d-none" onclick="edit_row();">Editar Usuario</button>
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
                    <th scope="col" class="text">Usuario</th>
                    <th scope="col" class="text">Contraseña</th>
                    <th scope="col" class="text">Tipo de Perfil</th>
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
              alert('Cuidado! Vuelva a seleccionar el tipo de perfil y asegúrese de que sea el correcto antes de guardar la edición.');
              alert('Edite en el formulario de arriba, y confirme');
              $('#title').html('Editar Usuario');
              $('#create').addClass('d-none');
              $('#edit, #cancelEdit').removeClass('d-none');
              $('#user').val( $('#string_'+id).html() );
              $('#password').val( $('#string2_'+id).html() );
              localStorage.setItem('editing', id);
            }
            function rollbackEditMode() {
              $('#title').html('Crear Usuario');
              $('#create').removeClass('d-none');
              $('#edit, #cancelEdit').addClass('d-none');
              $('#user').val('');
              $('#password').val('');
              localStorage.removeItem('editing');
            }

            /* API REST */
            function show(){
              $('#table').html('');
              $.ajax({
                  url: '{{route("users.show", 1)}}',
                  type: 'GET',
                  success: function(result) {
                    result.forEach( function(valor, indice, array) {

                      if(valor.profiletype == 1){
                        var profileString = 'Perfil General';
                      }
                      /* else if(valor.profiletype == 1){
                        var profileString = 'Seguridad Administrador';
                      }else if(valor.profiletype == 3){
                        var profileString = 'Seguridad Solo Lectura';
                      }else{
                        var profileString = 'Desconocido (modificar y setear uno)';
                      } */

                        $('#table').append('\
                          <tr>\
                              <th scope="row" class="align-middle">\
                                  <span id="string_' +valor.id+ '" class="font-weight-semi">' +valor.user+ '</span>\
                              </th>\
                              <th scope="row" class="align-middle">\
                                  <span id="string2_' +valor.id+ '" class="font-weight-semi">' +valor.password+ '</span>\
                              </th>\
                              <th scope="row" class="align-middle">\
                                  <span class="font-weight-semi">' +profileString+ '</span>\
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
                  url: '{{route("users.create")}}',
                  type: 'GET',
                  data: {user: $('#user').val(), password: $('#password').val(), profiletype: $('#profiletype').val()},
                  success: function(result) {
                      if(result === '1'){
                        alert('Creado exitosamente.');
                        $('#user, #password').val('');
                        show();
                      }
                  }
              });
            }
            function delete_row(id) {
              $.ajax({
                  url: '{{route("users.destroy", 1)}}'.replace('1', id),
                  type: 'DELETE',
                  success: function(result) {
                      alert('Borrado exitosamente.');
                      show();
                  }
              });
            }
            function edit_row(){
              $.ajax({
                url: '{{route("users.edit", 1)}}'.replace('1', localStorage.getItem('editing')),
                  type: 'GET',
                  data: {user: $('#user').val(), password: $('#password').val(), profiletype: $('#profiletype').val()},
                  success: function(result) {
                      if(result === '1'){
                        alert('Editado exitosamente.');
                        $('#user').val('');
                        $('#password').val('');
                        show();
                        rollbackEditMode();
                      }
                  }
              });

            }
          </script>

        @else

        <input onchange="superAdminLogin($(this).val());" type="text" class="form-control" placeholder="Contraseña Super Admin" style="border: 1px solid red; max-width: 200px; padding-left: 10px;">
        
        <script type="text/javascript">
          function superAdminLogin(password) {
            $.ajax({
                url: '{{route("superadmin")}}',
                type: 'POST',
                data: {password: password},
                success: function(result) {
                    /* alert(result); */
                    if(result == 0){
                      alert('Contraseña incorrecta.');
                    }else{
                      location.reload();
                    }
                }
            });
          }
        </script>

        @endif

@endsection