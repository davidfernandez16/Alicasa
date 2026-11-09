@extends('layouts.app')

@section('title', 'Administrador Ciudades')

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
        width: 22%;
    }
    table th:nth-child(3),
    table td:nth-child(3) {
        width: 22%;
    }
    table th:nth-child(4),
    table td:nth-child(4) {
        width: 22%;
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
            <option value="0">Código Postal</option>
            <option value="1">Localidad</option>
            <option value="2">Provincia</option>
            <option value="3">País</option>
        </select>
    </div>

    {{-- Tabla de Ciudades --}}
    @if ($relacion == 1)
        <h2>DATOS DE {{Str::upper($nombre)}}</h2>
    @else
        <h2>CIUDADES</h2>
    @endif
    <table border="1" id="ciudadesTable">
        <thead>
            <tr>
                <th>
                    Código Postal
                    <form action="{{ route('ordenar.ciudad', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'codigo_postal' ? 'activo' : '' }}" type="submit" name="columna" value="codigo_postal">
                            @if(request('columna') == 'codigo_postal' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'codigo_postal' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Localidad
                    <form action="{{ route('ordenar.ciudad', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'localidad' ? 'activo' : '' }}" type="submit" name="columna" value="localidad">
                            @if(request('columna') == 'localidad' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'localidad' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    Provincia
                    <form action="{{ route('ordenar.ciudad', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'provincia' ? 'activo' : '' }}" type="submit" name="columna" value="provincia">
                            @if(request('columna') == 'provincia' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'provincia' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th>
                    País
                    <form action="{{ route('ordenar.ciudad', $direccion) }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="ordenar {{ request('columna') == 'pais' ? 'activo' : '' }}" type="submit" name="columna" value="pais">
                            @if(request('columna') == 'pais' && $direccion == 'asc')
                                ↑
                            @elseif(request('columna') == 'pais' && $direccion == 'desc')
                                ↓
                            @else
                                -
                            @endif
                        </button>
                    </form>
                </th>
                <th class="administrador">
                    <form action="{{ route('ciudad.insertar_ciudad') }}" method="GET" style="display:inline;">
                        @csrf
                        <button class="insertar" type="submit"></button>
                    </form>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ciudades as $ciudad)
                <tr>
                    <td>{{ $ciudad->codigo_postal }}</td>
                    <td>{{ $ciudad->localidad }}</td>
                    <td>{{ $ciudad->provincia }}</td>
                    <td>{{ $ciudad->pais }}</td>
                    <td class="administrador">
                        <div class="borrar_editar">
                            <form action="{{ route('ciudad.eliminar', $ciudad->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="borrar" type="submit"></button>
                            </form>
                            <form action="{{ route('ciudad.modificar_ciudad', $ciudad->id) }}" method="GET" style="display:inline;">
                                @csrf
                                <button  class="editar" type="submit"></button>
                            </form>
                        </div>
                        <form action="{{ route('ciudad.ver_inmuebles', $ciudad->id) }}" target="_blank" method="GET" style="display:inline;">
                            @csrf
                            <button class="ver" type="submit"></button>
                        </form>
                    
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $ciudades->links('vendor.pagination.default') }}
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
            const rows       = document.querySelectorAll('#ciudadesTable tbody tr');

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