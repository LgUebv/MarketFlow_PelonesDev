<h1>Editar Producto: {{ $producto->nombre }}</h1>

<form action="{{ route('productos.update', $producto->id_producto) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="{{ $producto->nombre }}" required>
    </div><br>

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
</form>
