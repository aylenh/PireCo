@forelse ($distribuidores as $item)
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nombre Local</th>
                <th>Correo</th>
                <th>Numero de contacto</th>
                <th>Ubicacion</th>
                <th>Imagen</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$item->distribuidor_local}}</td>
                <td>{{$item->distribuidor_correo}}</td>
                <td>{{$item->distribuidor_contacto}}</td>
                <td>{{$item->distribuidor_ubicacion}}</td>
                <td><img src="/storage/files/{{ $item->distribuidor_imagen }}" alt="" class="d-flex align-self-start rounded mr-3"
                    height="64"></td>
                <td>
                    <button class="btn btn-sm btn-primary" data-id="{{$item->id}}" id="editarBtn">Editar</button>
                    <button class="btn btn-sm btn-danger" data-id="{{$item->id}}" id="eliminarBtn">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@empty
    <code>Ningun distribuidor encontrado.</code>
@endforelse
