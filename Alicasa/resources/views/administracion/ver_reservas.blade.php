@extends('layouts.app')

@section('title', 'Administrador Reservas')

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
        width: 15%;
    }
    table th:nth-child(2),
    table td:nth-child(2) {
        width: 15%;
    }
    table th:nth-child(3),
    table td:nth-child(3) {
        width: 10%;
    }
    table th:nth-child(4),
    table td:nth-child(4) {
        width: 12%;
    }
    table th:nth-child(5),
    table td:nth-child(5) {
        width: 12%;
    }
    table th:nth-child(6),
    table td:nth-child(6) {
        width: 12%;
    }
    table th:nth-child(7),
    table td:nth-child(7) {
        width: 12%;
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
    .editar:hover, .borrar:hover, .insertar:hover {
        border:1px solid black;
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
            <option value="0">Fecha Inicio</option>
            <option value="1">Fecha Fin</option>
            <option value="2">Días</option>
            <option value="3">Precio Total</option>
            <option value="4">Usuario</option>
            <option value="5">Inmueble</option>
        </select>
    </div>

    {{-- Tabla de Reservas --}}
    
    <h2>RESERVAS</h2>
    <table border="1" id="reservasTable">
        <thead>
            <tr>
                <th>
                    Fecha Inicio
                    <form action="{{ route('ordenar.reserva', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'fecha_inicio' ? 'activo' : '' }}" type="submit" name="columna" value="fecha_inicio">
                            @if(request('columna') == 'fecha_inicio' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'fecha_inicio' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Fecha Fin
                    <form action="{{ route('ordenar.reserva', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'fecha_fin' ? 'activo' : '' }}" type="submit" name="columna" value="fecha_fin">
                            @if(request('columna') == 'fecha_fin' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'fecha_fin' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Noches
                    <form action="{{ route('ordenar.reserva', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'dias' ? 'activo' : '' }}" type="submit" name="columna" value="dias">
                            @if(request('columna') == 'dias' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'dias' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Precio Total
                    <form action="{{ route('ordenar.reserva', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'precio_total' ? 'activo' : '' }}" type="submit" name="columna" value="precio_total">
                            @if(request('columna') == 'precio_total' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'precio_total' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Estado
                    <form action="{{ route('ordenar.reserva', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'estado' ? 'activo' : '' }}" type="submit" name="columna" value="estado">
                            @if(request('columna') == 'estado' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'estado' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Usuario
                    <form action="{{ route('ordenar.reserva', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'usuario' ? 'activo' : '' }}" type="submit" name="columna" value="usuario">
                            @if(request('columna') == 'usuario' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'usuario' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Inmueble
                    <form action="{{ route('ordenar.reserva', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'inmueble' ? 'activo' : '' }}" type="submit" name="columna" value="inmueble">
                            @if(request('columna') == 'inmueble' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'inmueble' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th class="administrador">
                    <form action="{{ route('reserva.insertar_reserva') }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="insertar" type="submit"></button>
                    </form>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservas as $reserva)
                @php
                    $nombre = App\Models\User::find($reserva->usuario)->nombre;
                    $fecha_inicio = \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d/m/Y');
                    $fecha_fin = \Carbon\Carbon::parse($reserva->fecha_fin)->format('d/m/Y');
                @endphp
                <tr>
                    <td>{{ $fecha_inicio }}</td>
                    <td>{{ $fecha_fin }}</td>
                    <td>{{ $reserva->dias }}</td>
                    <td>{{ $reserva->precio_total }} €</td>
                    <td>{{ $reserva->estado }}</td>
                    <td>
                        <form action="{{ route('reserva.ver_user', $reserva->usuario) }}" target="_blank" method="GET" style="display:inline;">
                            <button class="relacion" type="submit">{{ $nombre }}</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('reserva.ver_inmueble', $reserva->inmueble) }}" target="_blank" method="GET" style="display:inline;">
                            <button class="relacion" type="submit">{{ $reserva->inmueble }}</button>
                        </form>
                    </td>
                    <td class="administrador">
                    <form action="{{ route('reserva.eliminar', $reserva->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="borrar" type="submit"></button>
                    </form>
                    <form action="{{ route('reserva.modificar_reserva', $reserva->id) }}" method="GET" style="display:inline;">
                        @csrf
                        <button  class="editar" type="submit"></button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $reservas->links('vendor.pagination.default') }}
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
            const rows       = document.querySelectorAll('#reservasTable tbody tr');

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