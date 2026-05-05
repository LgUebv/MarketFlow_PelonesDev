<h1>CRUD de Productos (Prueba Técnica)</h1>

<!-- Botón para crear (Simulado con un link a un form sencillo) -->
<a href="{{ route('productos.create') }}"> <button>Crear Nuevo Producto</button> </a>

<table border="1" style="width:100%; margin-top: 20px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->id_producto }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->stock }}</td>
            <td>${{ $producto->precio }}</td>
            <td>
                <!-- Botón Modificar (Link de prueba) -->
                <form action="{{ route('productos.edit', $producto->id_producto) }}">
                    <button>Modificar</button>
                </form>

                <!-- Botón Eliminar -->
                <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Seguro?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
