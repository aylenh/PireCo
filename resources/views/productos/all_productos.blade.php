<table id="tblProductos" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Botella</th>
            <th>Descartable</th>
            <th>Litros</th>
            <th>Precio</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)


            <tr>
                <td>{{ $producto->producto_botella }}</td>
                <td>{{ $producto->producto_descartable }}</td>
                <td>{{ $producto->producto_litros }}</td>
                <td>{{ $producto->producto_precio }}</td>
                <td>
                    <button class="btn btn-sm btn-primary" data-id="{{ $producto->id }}"
                        id="editarBtn">Editar</button>
                    <button class="btn btn-sm btn-danger" data-id="{{ $producto->id }}"
                        id="eliminarBtn">Eliminar</button>
                </td>
            </tr>

        @endforeach
    </tbody>
</table>



<script>
    $(document).ready(function() {
        $('#tblProductos').DataTable({
            "language": {
                "search": "Buscar producto:",
                "lengthMenu": "Mostrando _MENU_ productos por página.",
                "zeroRecords": "Upss! Parece que aun no hay ningun producto agregado.",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "Sin productos añadidos.",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                }
            }
        });
    });
</script>
