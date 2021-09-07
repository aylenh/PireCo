@forelse ($distribuidores as $item)
    <div class="media mb-4">
        <img src="/storage/files/{{ $item->distribuidor_imagen }}" alt="" class="d-flex align-self-start rounded mr-3"
            height="64">
        <div class="media-body">
            <h5 class="mt-0 font-16">Nombre Local: {{ $item->distribuidor_local }}</h5>
            <h5 class="mt-0 font-16">Correo Electronico: {{ $item->distribuidor_correo }}</h5>
            <h5 class="mt-0 font-16">Telefono: {{ $item->distribuidor_contacto }}</h5>
            <div class="btn-group">
                <button class="btn btn-sm btn-primary">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
            </div>
        </div>
    </div>
@empty
    <code>Ningun distribuidor encontrado.</code>
@endforelse
