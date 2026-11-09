@extends('layouts.app')

@section('title', 'Administrador Inmuebles')

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
        width: 8%;
    }
    table th:nth-child(2),
    table td:nth-child(2) {
        width: 9%;
    }
    table th:nth-child(3),
    table td:nth-child(3) {
        width: 7%;
    }
    table th:nth-child(4),
    table td:nth-child(4) {
        width: 8%;
    }
    table th:nth-child(5),
    table td:nth-child(5) {
        width: 9%;
    }
    table th:nth-child(6),
    table td:nth-child(6) {
        width: 6%;
    }
    table th:nth-child(7),
    table td:nth-child(7) {
        width: 22%;
    }
    table th:nth-child(8),
    table td:nth-child(8) {
        width: 5%;
    }
    table th:nth-child(9),
    table td:nth-child(9) {
        width: 6%;
    }
    table th:nth-child(10),
    table td:nth-child(10) {
        width: 6%;
    }
    table th:nth-child(11),
    table td:nth-child(11) {
        width: 9%;
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
        text-align: center;
        color: #009FA8;
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
    .relacion{
        background-color: white;
        border:none;
        font-size: 15px;
        padding: 0px;
        cursor:pointer;
        transition: all 0.3s ease-in-out;
        border-bottom: 1px solid white;
    }
    .relacion:hover{
        border-bottom: 1px solid black;
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
            <option value="0">Direccion</option>
            <option value="1">Habitaciones</option>
            <option value="2">Superficie</option>
            <option value="3">Categoría</option>
            <option value="4">Precio</option>
            <option value="6">Descripcion</option>
            <option value="7">Ciudad</option>
            <option value="8">Propietario</option>
        </select>
    </div>

    {{-- Tabla de Inmuebles --}}
    @if ($relacion == 1)
        <h2>DATOS DEL INMUEBLE {{$nombre}}</h2>
    @elseif ($relacion == 2)
        <h2>INMUEBLES DE {{Str::upper($nombre)}} {{Str::upper($apellidos)}}</h2>
    @elseif ($relacion == 3)
        <h2>INMUEBLES EN {{Str::upper($localidad)}}</h2>
    @else
        <h2>INMUEBLES</h2>
    @endif
    <table border="1" id="inmueblesTable">
        <thead>
            <tr>
                <th>
                    Dirección
                    <form action="{{ route('ordenar.inmueble', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'direccion' ? 'activo' : '' }}" type="submit" name="columna" value="direccion">
                            @if(request('columna') == 'direccion' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'direccion' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Habitaciones
                    <form action="{{ route('ordenar.inmueble', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'num_habitaciones' ? 'activo' : '' }}" type="submit" name="columna" value="num_habitaciones">
                            @if(request('columna') == 'num_habitaciones' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'num_habitaciones' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Superficie
                    <form action="{{ route('ordenar.inmueble', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'superficie' ? 'activo' : '' }}" type="submit" name="columna" value="superficie">
                            @if(request('columna') == 'superficie' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'superficie' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Categoría
                    <form action="{{ route('ordenar.inmueble', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'categoria' ? 'activo' : '' }}" type="submit" name="columna" value="categoria">
                            @if(request('columna') == 'categoria' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'categoria' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Precio/Noche
                    <form action="{{ route('ordenar.inmueble', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'precio' ? 'activo' : '' }}" type="submit" name="columna" value="precio">
                            @if(request('columna') == 'precio' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'precio' && $direccion == 'desc')
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
                    Descripcion
                    <form action="{{ route('ordenar.inmueble', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'descripcion' ? 'activo' : '' }}" type="submit" name="columna" value="descripcion">
                            @if(request('columna') == 'descripcion' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'descripcion' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    WiFi
                    <form action="{{ route('ordenar.inmueble', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'wifi' ? 'activo' : '' }}" type="submit" name="columna" value="wifi">
                            @if(request('columna') == 'wifi' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'wifi' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Piscina
                    <form action="{{ route('ordenar.inmueble', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'piscina' ? 'activo' : '' }}" type="submit" name="columna" value="piscina">
                            @if(request('columna') == 'piscina' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'piscina' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Ciudad
                    <form action="{{ route('ordenar.inmueble', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'ciudad' ? 'activo' : '' }}" type="submit" name="columna" value="ciudad">
                            @if(request('columna') == 'ciudad' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'ciudad' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Propietario
                    <form action="{{ route('ordenar.inmueble', $direccion) }}" method="GET" style="display:inline;">
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
                <th class="administrador">
                    <form action="{{ route('inmueble.insertar_inmueble') }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="insertar" type="submit"></button>
                    </form>
                </th>
            </tr>
        </thead>
        <tbody>    
            @foreach ($inmuebles as $inmueble)
            <tr>
                @php
                    $nombre = App\Models\User::find($inmueble->propietario)->nombre;
                    $localidad = App\Models\Ciudad::find($inmueble->ciudad)->localidad;
                @endphp
                <td>{{ $inmueble->direccion }}</td>
                <td>{{ $inmueble->num_habitaciones }}</td>
                <td>{{ $inmueble->superficie }}</td>
                <td>@if($inmueble->categoria == "Casa_rural")
                        Casa Rural
                    @else
                        {{ $inmueble->categoria }}
                    @endif
                </td>
                <td>{{ $inmueble->precio }} €</td>
                <td><img src="{{ asset($inmueble->imagen) }}" width="50"></td>
                <td>{{ $inmueble->descripcion }}</td>
                <td>{{ $inmueble->wifi ? 'Sí' : 'No' }}</td>
                <td>{{ $inmueble->piscina ? 'Sí' : 'No' }}</td>
                <td>
                    <form action="{{ route('inmueble.ver_ciudad', $inmueble->ciudad) }}" method="GET" target="_blank" style="display:inline;">
                        <button class="relacion" type="submit">{{ $localidad }}</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('inmueble.ver_user', $inmueble->propietario) }}" method="GET" target="_blank" style="display:inline;">
                        <button class="relacion" type="submit">{{ $nombre }}</button>
                    </form>
                </td>

                <td class="administrador">
                    <div class="borrar_editar">
                        <form action="{{ route('inmueble.eliminar', $inmueble->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="borrar" type="submit"></button>
                        </form>
                        <form action="{{ route('inmueble.modificar_inmueble', $inmueble->id) }}" method="GET" style="display:inline;">
                            @csrf
                            <button class="editar" type="submit"></button>
                        </form>
                    </div>
                    <form action="{{ route('inicio.inmueble', $inmueble->id) }}" target="_blank" method="GET" style="display:inline;">
                        @csrf
                        <button class="ver" type="submit"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $inmuebles->links('vendor.pagination.default') }}
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
            const rows       = document.querySelectorAll('#inmueblesTable tbody tr');

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