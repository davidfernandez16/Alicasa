@extends('layouts.app')

@section('title', 'Administrador Usuarios')

@section('content')
<style>
    body{
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        background-attachment: fixed;
    }
    .container {
        display: flex;
        flex-direction: column;
        font-family: "arial";
        min-height: 300px;
        box-shadow: 0px 0px 15px 10px rgba(0, 0, 0, 0.1);
        width: 80%;
        margin:80px auto 20px;
        align-items: center;
        padding: 30px;
        border: 3px solid #003f5c;
        border-radius: 12px;
        background-color: white;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table th:nth-child(1),
    table td:nth-child(1) {
        width: 22%;
    }
    table th:nth-child(2),
    table td:nth-child(2) {
        width: 12%;
    }
    table th:nth-child(3),
    table td:nth-child(3) {
        width: 12%;
    }
    table th:nth-child(4),
    table td:nth-child(4) {
        width: 12%;
    }
    table th:nth-child(5),
    table td:nth-child(5) {
        width: 8%;
    }
    table th:nth-child(6),
    table td:nth-child(6) {
        width: 12%;
    }
    table th:nth-child(7),
    table td:nth-child(7) {
        width: 13%;
    }
    th, td {
        border: 1px solid black;
        padding: 5px;
        text-align: center;
        word-break: break-word;
        overflow-wrap: break-word;
    }
    th {
        background: #ccc;
    }
    .titulo{
        color:#009FA8;
        text-align: center;
        font-size: 35px;
        font-weight: bold;
    }
    h2{
        color: #009FA8;
        text-align: center;
    }
    .boton2 {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 16px;
        background-color: white;
        border: 2px solid #003f5c;
        color: #003f5c;
        border-radius: 50px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        position: absolute;
        z-index: 1;
        left: 12%;
        margin-top: 0px;
    }
    .boton2:hover {
        background-color: #009FA8;
        color: white;
        border-color:#009FA8;
        transform: scale(1.05);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    .administrador{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        
    }
    .borrar_editar{
        display: flex;
        flex-direction: column;
    }
    .insertar{
        border-radius:50%;
        background-image: url("{{ asset('img/insertar.png') }}");
        background-size:100%;
        background-position: center;
        border:1px solid #ccc;
        width: 45px;
        height: 45px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }
    .editar{
        border-radius:50%;
        background-image: url("{{ asset('img/editar.png') }}");
        background-size:100%;
        background-position: center;
        border:1px solid white;
        width: 45px;
        height: 45px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }
    .borrar{
        border-radius:50%;
        background-image: url("{{ asset('img/borrar.png') }}");
        background-size:100%;
        background-position: center;
        border:1px solid white;
        width: 45px;
        height: 45px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }
    .ver{
        border-radius:50%;
        background-image: url("{{ asset('img/ver.png') }}");
        background-size:100%;
        background-position: center;
        border:1px solid white;
        width: 45px;
        height: 45px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }
    .editar:hover, .borrar:hover, .insertar:hover, .ver:hover {
        border-color: black;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .imagen_perfil {
        width: 60px;
        height: 60px;
        visibility: visible;
        border-radius: 50%;
    }
    .ordenar{
        cursor: pointer;
        font-size: 15px;
        border: 1px solid black;
        border-radius: 2px;
    }
    .ordenar.activo {
        color: #009FA8;
        border: 1px solid #009FA8;
    }
    .buscar{
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 40px;
        margin-top:20px;
        border-radius: 50px;
    }
    .buscar input{
        width: 80%;
        border: 1px solid #ccc;
        border-top-left-radius: 50px;
        border-bottom-left-radius: 50px;
        text-align: center;
    }
    .buscar select{
        width: 20%;
        border: 1px solid #ccc;
        border-top-right-radius: 50px;
        border-bottom-right-radius: 50px;
        text-align: center;
    }
</style>

    <div class="titulo">
        ADMINISTRACION
        <form action="{{ route('admin') }}" method="GET" style="display:inline;">
            @csrf
            <button class="boton2" type="submit">Volver</button>
        </form>
    </div>

    {{-- Filtros de búsqueda --}}
    <div class="buscar">
        <input type="text" id="searchInput" placeholder="Buscar en esta página" onkeyup="filterTable()" disabled>  
        <select id="columnFilter" onchange="handleSelectChange()">
            <option value="" selected>Seleccionar columna</option>
            <option value="0">Email</option>
            <option value="1">Nombre</option>
            <option value="2">Apellidos</option>
            <option value="3">Teléfono</option>
        </select>
    </div>
    
    {{-- Tabla de Usuarios --}}
    @if ($relacion == 1)
        <h2>DATOS DE {{Str::upper($nombre)}}</h2>
    @else
        <h2>USUARIOS</h2>
    @endif
    <table border="1" id="usuariosTable">
        <thead>
        <tr>
            <th>
                Email
                <form action="{{ route('ordenar.user', $direccion) }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="ordenar {{ request('columna') == 'email' ? 'activo' : '' }}" type="submit" name="columna" value="email">
                        @if(request('columna') == 'email' && $direccion == 'asc')
                            ↑
                        @elseif(request('columna') == 'email' && $direccion == 'desc')
                            ↓
                        @else
                            -
                        @endif
                    </button>
                </form>
            </th>
            <th>
                Nombre
                <form action="{{ route('ordenar.user', $direccion) }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="ordenar {{ request('columna') == 'nombre' ? 'activo' : '' }}" type="submit" name="columna" value="nombre">
                        @if(request('columna') == 'nombre' && $direccion == 'asc')
                            ↑
                        @elseif(request('columna') == 'nombre' && $direccion == 'desc')
                            ↓
                        @else
                            -
                        @endif
                    </button>
                </form>
            </th>
            <th>
                Apellidos
                <form action="{{ route('ordenar.user', $direccion) }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="ordenar {{ request('columna') == 'apellidos' ? 'activo' : '' }}" type="submit" name="columna" value="apellidos">
                        @if(request('columna') == 'apellidos' && $direccion == 'asc')
                            ↑
                        @elseif(request('columna') == 'apellidos' && $direccion == 'desc')
                            ↓
                        @else
                            -
                        @endif
                    </button>
                </form>
            </th>
            <th>
                Teléfono
                <form action="{{ route('ordenar.user', $direccion) }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="ordenar {{ request('columna') == 'telefono' ? 'activo' : '' }}" type="submit" name="columna" value="telefono">
                        @if(request('columna') == 'telefono' && $direccion == 'asc')
                            ↑
                        @elseif(request('columna') == 'telefono' && $direccion == 'desc')
                            ↓
                        @else
                            -
                        @endif
                    </button>
                </form>
            </th>
            <th>
                Imagen
            </th>
            <th>
                Propietario
                <form action="{{ route('ordenar.user', $direccion) }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="ordenar {{ request('columna') == 'propietario' ? 'activo' : '' }}" type="submit" name="columna" value="propietario">
                        @if(request('columna') == 'propietario' && $direccion == 'asc')
                            ↑
                        @elseif(request('columna') == 'propietario' && $direccion == 'desc')
                            ↓
                        @else
                            -
                        @endif
                    </button>
                </form>
            </th>
            <th>
                Administrador
                <form action="{{ route('ordenar.user', $direccion) }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="ordenar {{ request('columna') == 'administrador' ? 'activo' : '' }}" type="submit" name="columna" value="administrador">
                        @if(request('columna') == 'administrador' && $direccion == 'asc')
                            ↑
                        @elseif(request('columna') == 'administrador' && $direccion == 'desc')
                            ↓
                        @else
                            -
                        @endif
                    </button>
                </form>
            </th>
            <th class="administrador">
                <form action="{{ route('user.insertar_user') }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="insertar" type="submit"></button>
                </form>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->apellidos }}</td>
                <td>{{ $usuario->telefono }}</td>
                <td><img src="{{ asset($usuario->imagen) }}" width="50" class="imagen_perfil"></td>
                <td>{{ $usuario->propietario ? 'Sí' : 'No' }}</td>
                <td>{{ $usuario->administrador ? 'Sí' : 'No' }}</td>
                <td class="administrador">
                    <div class="borrar_editar">
                        <form action="{{ route('user.eliminar', $usuario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="borrar" type="submit"></button>
                        </form>
                        <form action="{{ route('user.modificar_user', $usuario->id) }}" method="GET" style="display:inline;">
                            @csrf
                            <button class="editar" type="submit"></button>
                        </form>    
                    </div>
                    @if($usuario->propietario == 1)
                        <form action="{{ route('user.ver_inmuebles', $usuario->id) }}" target="_blank" method="GET" style="display:inline;">
                            @csrf
                           <button class="ver" type="submit"></button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $usuarios->links('vendor.pagination.default') }}
    <script>
        function handleSelectChange() {
            const select   = document.getElementById('columnFilter');
            const input    = document.getElementById('searchInput');
            const hasCol   = select.value !== '';

            // habilitar / deshabilitar el input
            input.disabled = !hasCol;
            if (!hasCol) {
                input.value = '';
                filterTable();       // Restablecer la tabla
            } else {
                input.focus();
            }
        }

        function filterTable() {
            const selectVal  = document.getElementById('columnFilter').value;
            if (selectVal === '') return;      // No hay columna elegida → salir
            
            const searchText = document.getElementById('searchInput').value.toLowerCase();
            const rows       = document.querySelectorAll('#usuariosTable tbody tr');

            rows.forEach(row => {
                const cells      = row.querySelectorAll('td');
                const colIndex   = parseInt(selectVal);
                const isImageCol = colIndex === 5;          // por si añades más columnas

                // Mostrar siempre si la columna es la de imagen (no se filtra)  
                if (isImageCol) { row.style.display = ''; return; }

                const cellText = cells[colIndex]?.textContent.toLowerCase() || '';
                row.style.display = cellText.includes(searchText) ? '' : 'none';
            });
        }

        // Hacer que el select empiece controlando el input
        window.addEventListener('DOMContentLoaded', handleSelectChange);
    </script>

@endsection