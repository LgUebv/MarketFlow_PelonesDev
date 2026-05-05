<h1>Editar Producto: {{ $producto->nombre }}</h1>

<h3>Imágenes del Producto</h3>
<div style="display: flex; gap: 10px; margin-bottom: 20px;">
    @foreach($producto->imagenes as $img)
        <div style="border: 1px solid #ccc; padding: 5px; text-align: center;">
            <img src="{{ str_starts_with($img->rutaImagen, 'http') ? $img->rutaImagen : asset('storage/' . $img->rutaImagen) }}"
                width="100" height="100" style="object-fit: cover;">
            <br>
            @if($img->portada)
                <span style="color: green; font-weight: bold;">Portada</span>
            @else
                <!-- Formulario pequeño para setear como portada -->
                <form action="{{ route('productos.setPortada', [$producto, $img]) }}" method="POST" enctype="multipart/form-data" style="display:inline;">
                    @csrf
                    <button type="submit" style="font-size: 10px;">Poner Portada</button>
                </form>
                <br>
                <!-- Formulario para eliminar -->
                <form action="{{ route('productos.destroyImagen', $img->id_imagen) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color: red; font-size: 10px;">Eliminar</button>
                </form>
            @endif
        </div>
    @endforeach
</div>

<form action="{{ route('productos.update', $producto->id_producto) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="{{ $producto->nombre }}" required>
    </div><br>
</form>

<!-- Formulario para añadir MÁS fotos (ya tienes la función addImagenes en el controlador) -->
<form action="{{ route('productos.addImagenes', $producto->id_producto) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="fotos[]" multiple accept="image/*">
    <button type="submit">Añadir Fotos</button>
</form>

<div>
    <label>Categoría:</label><br>
    <select name="id_categoria" required>
        @foreach($categorias as $cat)
            <option value="{{ $cat->id_categoria }}" {{ $cat->id_categoria == $producto->id_categoria ? 'selected' : '' }}>
                {{ $cat->nombre }}
            </option>
        @endforeach
    </select>
</div><br>

<div>
    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3">{{ $producto->descripcion }}</textarea>
</div><br>

<div>
    <label>Stock:</label><br>
    <input type="number" name="stock" value="{{ $producto->stock }}" required>
</div><br>

<div>
    <label>Precio:</label><br>
    <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required>
</div><br>

<button type="submit">Actualizar Producto</button>
<a href="{{ route('productos.index') }}">Cancelar</a>

