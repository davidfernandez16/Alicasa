@extends('layouts.app')

@section('title', 'Ver Reservas')

@section('content')
<style>
    body{
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        background-attachment: fixed;
    }
    .container {
        font-family: "Arial", sans-serif;
        display: flex;
        flex-direction: column;
        width: 80%;
        margin: 80px auto 20px;
        padding: 30px;
        background: white;
        border-radius: 12px;
        box-shadow: 0px 0px 15px 10px rgba(0, 0, 0, 0.1);
        min-height: 300px;
        border: 3px solid #003f5c;
        gap:15px;
    }
    .titulo{
        color:#003f5c;
        text-align: center;
        font-size: 35px;
        font-weight: bold;
        margin-top:50px;
        margin-bottom: 50px;
    }
    .filtro{
        display: flex;
        flex-direction: row;
        width: 90%;
        margin: 0 auto;
        align-items: center;
        justify-content: space-around;
    }
    .filtro button {
        background-color: white; /* Fondo blanco por defecto */
        color: black; /* Texto negro por defecto */
        border: 2px solid #003f5c;
        font-size: 16px;
        font-weight: bold;
        width: 150px;
        color: #003f5c;
        border-radius: 50px;
        padding: 10px 20px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .filtro button.active {
        background-color: #003f5c; /* Fondo del botón activo */
        color: white; /* Texto blanco para el botón activo */
        border-color: #003f5c; /* Borde del botón activo */
    }

    .filtro button:hover {
        background-color: #003f5c; /* Fondo al pasar el ratón */
        color: white;
    }
    .reservas{
        display: flex;
        flex-direction: column;
        width: 90%;
        margin: 0 auto;
        align-items: center;
        gap: 40px;
    }
    .reservas-info{
        display:flex;
        flex-direction: row;
        padding: 20px;
        gap:10px;
        border:2px solid #003f5c;
        border-radius: 25px;
        background-color: white;
        box-shadow: 0px 0px 15px 10px rgba(0, 0, 0, 0.1);
        align-items: center;
        justify-content: space-around;
        width: 800px;
        margin-bottom: 20px;
    }
    .reserva-usuario{
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 3px solid #003f5c;
    }
    .reserva-detalles{
        display: flex;
        flex-direction: column;
        width: 40%;
        gap: 10px;
        padding: 10px;
    }
    .reserva-detalles-info{
        display: flex;
        flex-direction: row;
        gap: 10px;
    }
    .etiqueta{
        font-size: 20px;
        font-weight: bold;
        color: #003f5c;
        width: 130px;
    }
    .valor{
        font-size: 18px;
        color: black;
    }
    .administrar{
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .cancelar{
        background-image: url("{{ asset('img/cancelar.png') }}");
        background-size:90%;
        background-position: center;
        width: 45px;
        height: 45px;
        border: 2px solid white;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }
    .aceptar{
        background-image: url("{{ asset('img/aceptar.png') }}");
        background-size:90%;
        background-position: center;
        width: 45px;
        height: 45px;
        border: 2px solid white;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    .administrar button:hover{
        border: 2px solid #003f5c;
    }
    .mensaje-vacio {
        margin: 30px 0;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        font-size: 18px;
        color: #6c757d;
    }
    .reserva {
        display: none;
    }

    .reserva.mostrar {
        display: block;
    }
    .separar{
        width: 100%;
        border: 1px solid #003f5c;
    }
</style>

<div class="titulo">ADMINISTRAR RESERVAS - {{ Str::upper($direccion) }}</div>

<div class="filtro">
    <button id="Pendientes" class="active" onclick="cambiarFiltro(this, 'pendiente')">Pendientes</button>
    <button id="Aceptadas" onclick="cambiarFiltro(this, 'aceptada')">Aceptadas</button>
    <button id="Canceladas" onclick="cambiarFiltro(this, 'cancelada')">Canceladas</button>
</div>

<div class="separar"></div>

<div class="reservas">
    <div class="reserva pendiente mostrar">
        @if ($cantidad_pendientes > 0)
            @foreach($pendientes as $pendiente)
                @php
                    $imagen = App\Models\User::findOrFail($pendiente->usuario)->imagen;
                    $nombre = App\Models\User::findOrFail($pendiente->usuario)->nombre;
                    $apellido = App\Models\User::findOrFail($pendiente->usuario)->apellidos;
                @endphp
                <div class="reservas-info">
                    <img class="reserva-usuario" src="{{ asset($imagen) }}">
                    <div class="reserva-detalles">
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Usuario:</label>
                            <label class="valor">{{ $nombre }} {{ $apellido}}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Fecha Inicio:</label>
                            <label class="valor">{{ $pendiente->fecha_inicio }}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Fecha Final:</label>
                            <label class="valor">{{ $pendiente->fecha_fin }}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Dias:</label>
                            <label class="valor">{{ $pendiente->dias }}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Precio Total:</label>
                            <label class="valor">{{ $pendiente->precio_total }}</label>
                        </div>
                    </div>
                    <div class="administrar">
                        <form action="{{ route('propietario.cancelar', $pendiente->id) }}" method="GET" style="display:inline;">
                            @csrf
                            <button class="cancelar"></button>
                        </form>
                        <form action="{{ route('propietario.aceptar',$pendiente->id) }}" method="GET" style="display: inline;">
                            @csrf
                            <button class="aceptar"></button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="mensaje-vacio">
                No quedan reservas pendientes.
            </div>
        @endif
    </div>
    <div class="reserva aceptada mostrar">
        @if ($cantidad_aceptadas > 0)
            @foreach($aceptadas as $aceptada)
                @php
                    $imagen = App\Models\User::findOrFail($aceptada->usuario)->imagen;
                    $nombre = App\Models\User::findOrFail($aceptada->usuario)->nombre;
                    $apellido = App\Models\User::findOrFail($aceptada->usuario)->apellidos;
                @endphp
                <div class="reservas-info">
                    <img class="reserva-usuario" src="{{ asset($imagen) }}">
                    <div class="reserva-detalles">
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Usuario:</label>
                            <label class="valor">{{ $nombre }} {{ $apellido}}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Fecha Inicio:</label>
                            <label class="valor">{{ $aceptada->fecha_inicio }}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Fecha Final:</label>
                            <label class="valor">{{ $aceptada->fecha_fin }}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Dias:</label>
                            <label class="valor">{{ $aceptada->dias }}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Precio Total:</label>
                            <label class="valor">{{ $aceptada->precio_total }}</label>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="mensaje-vacio">
                No hay reservas aceptadas.
            </div>
        @endif
    </div>
    <div class="reserva cancelada mostrar">
        @if ($cantidad_canceladas > 0)
            @foreach($canceladas as $cancelada)
                @php
                    $imagen = App\Models\User::findOrFail($cancelada->usuario)->imagen;
                    $nombre = App\Models\User::findOrFail($cancelada->usuario)->nombre;
                    $apellido = App\Models\User::findOrFail($cancelada->usuario)->apellidos;
                @endphp
                <div class="reservas-info">
                    <img class="reserva-usuario" src="{{ asset($imagen) }}">
                    <div class="reserva-detalles">
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Usuario:</label>
                            <label class="valor">{{ $nombre }} {{ $apellido}}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Fecha Inicio:</label>
                            <label class="valor">{{ $cancelada->fecha_inicio }}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Fecha Final:</label>
                            <label class="valor">{{ $cancelada->fecha_fin }}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Dias:</label>
                            <label class="valor">{{ $cancelada->dias }}</label>
                        </div>
                        <div class="reserva-detalles-info">
                            <label class="etiqueta">Precio Total:</label>
                            <label class="valor">{{ $cancelada->precio_total }}</label>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="mensaje-vacio">
                No hay reservas canceladas.
            </div>
        @endif
    </div>
</div>

<script>
    function cambiarFiltro(botonSeleccionado, filtro) {
        const botones = document.querySelectorAll('.filtro button');

        botones.forEach(boton => boton.classList.remove('active'));

        botonSeleccionado.classList.add('active');

        const reservas = document.querySelectorAll('.reserva');

        reservas.forEach(reserva => {
            if (reserva.classList.contains(filtro)) {
                reserva.classList.add('mostrar');
            } else {
                reserva.classList.remove('mostrar');
            }
        });
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        cambiarFiltro(document.getElementById('Pendientes'), 'pendiente');
    });
</script>

@endsection