@extends('general')

@section('content')
        <form>
            <div class="container my-lg">
                <h2 class="doc-section-title" id="title">Login<a class="section-link" href="#examples"></a><span class="border-bottom"></span></h2>
                <div class="doc-example">
                    <div class="row">
                        <div class="col-md-6">
                            <form>
                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Usuario</label>
                                    <input type="input" class="form-control" id="user" aria-describedby="emailHelp" placeholder="Usuario">
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label for="exampleInputEmail1" class="bmd-label-static">Contraseña</label>
                                    <input type="password" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Contraseña">
                                </div>
                                <button id="create" type="button" class="btn btn-raised-primary" onclick="login();">Ingresar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    <div class="card table-responsive">

      <script type="text/javascript">
        function login() {
          $.ajax({
              url: '{{route("login.create")}}',
              type: 'GET',
              data: {user: $('#user').val(), password: $('#password').val()},
              success: function(result) {
                  if(result > 0){
                    alert('Logeado exitosamente.');
                    if(result == 1){
                        window.location.href="{{route('dashboard.index')}}";
                    }else{
                        window.location.href="{{route('dashboard.index')}}";
                    }
                  }else{
                    alert('Usuario y/o contraseña incorrectos.');
                  }
              }
          });
        }
      </script>

@endsection