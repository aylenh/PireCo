@extends('general')

@section('content')

<form>
      <div class="container my-lg">
          <h2 class="doc-section-title" id="title">Egresos por Caja<a class="section-link" href="#examples"></a><span class="border-bottom"></span></h2>
          <div class="doc-example">
              <div class="row">
                  <div class="col-md-6">
                      <form>
                          @for ($i = 1; $i <= 20; $i++)
                              <div class="form-group bmd-form-group">
                                  <label for="exampleInputEmail1" class="bmd-label-static">Nombre del Servicio {{$i}}</label>
                                  <input type="input" class="form-control inputToClean" id="service{{$i}}" aria-describedby="" placeholder="Nombre del Servicio {{$i}}">
                              </div>
                              <div class="form-group bmd-form-group" style="display: none;">
                                  <label for="exampleInputEmail1" class="bmd-label-static">Costo del Servicio {{$i}}</label>
                                  <input type="input" class="form-control inputToClean" id="price{{$i}}" aria-describedby="" placeholder="Costo del Servicio {{$i}}">
                              </div>
                          @endfor
                          <br>
                          <button id="create" type="button" class="btn btn-raised-primary" onclick="edit_row();">Guardar Egresos por Caja</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </form>

  <script type="text/javascript">

    $(document).ready( renderEdit );

    function renderEdit() {

      $.ajax({
          url: '{{route("cashoutcome.show", 1)}}',
          type: 'GET',
          success: function(result) {
            result.forEach( function(valor, indice, array) {
                if(true) {

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

                }
            });
          }
      });

    }
    function rollbackEditMode() {
      $('#title').html('Crear Usuario');
      $('#create').removeClass('d-none');
      $('#edit, #cancelEdit').addClass('d-none');
      $('.inputToClean').val('');
      $('#idCLient option[value=""]').attr('selected','selected');
      localStorage.removeItem('editing');
    }

    function edit_row(){
      $.ajax({
        url: '{{route("cashoutcome.edit", 1)}}',
          type: 'GET',
          data: {

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

          },
          success: function(result) {
              if(result === '1'){
                alert('Guardado exitosamente.');
                location.reload();
              }
          }
      });

    }
  </script>

@endsection