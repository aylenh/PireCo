    <table id="tblDistribuidores" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Local</th>
                <th>Correo</th>
                <th>Contacto</th>
                <th>Ubicación</th>
                <!--<th>Imagen</th>-->
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($distribuidores as $distribuidor)


                <tr>
                    <td>{{ $distribuidor->distribuidor_local }}</td>
                    <td>{{ $distribuidor->distribuidor_correo }}</td>
                    <td>{{ $distribuidor->distribuidor_contacto }}</td>
                    <td>{{ $distribuidor->distribuidor_ubicacion }}</td>
                    <!--<td><img src="/storage/files/{{ $distribuidor->distribuidor_imagen }}" alt=""
                            class="d-flex align-self-start rounded mr-3" height="64"></td>-->
                    <td>
                        <button class="btn btn-sm btn-primary" data-id="{{ $distribuidor->id }}"
                            id="editarBtn">Editar</button>
                        <button class="btn btn-sm btn-danger" data-id="{{ $distribuidor->id }}"
                            id="eliminarBtn">Eliminar</button>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>



    <script>
        $(document).ready(function() {
            $('#tblDistribuidores').DataTable({
                "language": {
                    "search": "Buscar distribuidor:",
                    "lengthMenu": "Mostrando _MENU_ distribuidores por página.",
                    "zeroRecords": "Upss! Parece que aun no hay ningun distribuidor agregado.",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "Sin distribuidores añadidos.",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    }
                }
            });
        });
    </script>
