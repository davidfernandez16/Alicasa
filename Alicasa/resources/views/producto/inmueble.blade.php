@extends('layouts.app')

@section('title', 'Inmueble')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
    .container-re{
        font-family: "Arial", sans-serif;
        display: flex;
        flex-direction: row;
        width: 80%;
        margin: 80px auto 20px;
        margin-bottom: 50px;
        padding: 30px;
        background: white;
        border-radius: 12px;
        box-shadow: 0px 0px 15px 10px rgba(0, 0, 0, 0.1);
        min-height: 300px;
        border: 3px solid #009FA8;
    }
    .volver {
        padding: 10px 20px;
        font-size: 16px;
        background-color: white;
        border: 2px solid #003f5c;
        color: #003f5c;
        border-radius: 50px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        margin-bottom: 20px;
    }
    .volver:hover {
        background-color: #009FA8;
        color: white;
        border-color: #009FA8;
        transform: scale(1.05);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    .titulo-pagina{
        display: flex;
        font-size: 25px;
        font-weight: bold;
        color: #003f5c;
        width: 100%;
        justify-content: center;
        text-align: center;
        align-items: center;
    }
    .inmueble-info{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
    }
    .inmueble-imagen{
        width: 50%;
        padding: 15px;
        border-radius: 25px;
    }
    .inmueble-info-detalles{
        display: flex;
        flex-direction: column;
        width: 30%;
        gap: 25px;
        padding: 15px;
    }
    .inmueble-info-detalles-partes{
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .titulo{
        width: 100%;
        font-size: 20px;
        font-weight: bold;
        color: #003f5c;
        text-align: center;
        border-bottom: 3px solid #009FA8;
    }
    .detalles {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }
    .etiqueta {
        width: 110px;
        font-weight: bold;
        color: #000000;
    }
    .valor {
        text-align: left;
        color: #333;
    }
    .reservar{
        display: flex;
        flex-direction: column;
        width: 30%;
        border: 3px solid #009FA8;
        border-radius: 20px;
        padding: 15px;
    }
    .resenyas{
        display: flex;
        flex-direction: column;
        width: 50%;
        padding: 15px;
        border-radius: 20px;
    }
    .resenya-dentro{
        display:flex;
        flex-direction: column;
        width: 100%;
        gap: 20px;
    }
    .comentar{
        display: flex;
        flex-direction: column;
        padding-left: 15px;
        padding-right: 15px;
        margin-bottom: 15px;
        gap:5px
    }
    .comentar-valor1{
        display:flex;
        flex-direction: row;
        gap: 0px;
        cursor: pointer;
    }
    .comentar-valor2{
        display:flex;
        flex-direction: row;
        gap: 0px;
        cursor: pointer;
    }
    .comentar-comentario {
        width: 50%;
        height: auto;
        min-height: 50px;
        max-height: 300px;
        resize: none;
        padding: 10px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        border: 2px solid #009FA8;
        border-radius: 8px;
    }
    .comentar-comentario:focus {
        outline: none;
        border-color: #009FA8;
        box-shadow: 0px 4px 8px rgba(0, 63, 92, 0.2);
    }
    .comentar button{
        display: flex;
        justify-content: center;
        width: 20%;
        font-size:15px;
        padding: 7px;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        background-color: #003f5c;
        border: 2px solid #003f5c;
        color: white;
        border-radius: 50px;
        cursor: pointer;
    }
    .comentar button:hover{
        background-color: white;
        color: #003f5c;
        border-color: #003f5c;
    }
    .comentario-boton{
        display: flex;
        justify-content: center;
        padding: 10px;
    }
    .comentario{
        display: flex;
        flex-direction: column;
        border: 3px solid #003f5c;
        border-radius: 15px;
        padding: 15px;
        gap:5px;
        word-break: break-word;
        overflow-wrap: break-word;
    }
    .mi-comentario{
        display: flex;
        flex-direction: column;
        border: 3px solid #003f5c;
        border-radius: 15px;
        padding: 15px;
        gap:5px;
        margin-bottom: 20px;
        word-break: break-word;
        overflow-wrap: break-word;
    }
    .comentario-detalles{
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 5px;
    }
    .comentario-valor{
        display: flex;
        font-size: 18px;
        color: #003f5c;
        gap: 0px;
    }
    .comentario-etiqueta{
        width: 190px;
        font-size: 16px;
        font-weight: bold;
        color: black;
    }
    .comentar-titulo{
        font-size: 18px;
        color: #003f5c;
        font-weight: bold;
        margin-bottom: 7px;
        text-align: center;
    }
    .resenya-imagen{
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: none;
    }
    .estrella{
        width: 20px;
        height: 20px;
    }
    .reservas-dentro{
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
        align-items: center;
    }
    .dentro-fecha{
        display: flex;
        flex-direction: row;
        width: 100%;
        justify-content: space-around;
        margin-top: 20px;
    }
    .fechas{
        width: 45%;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: #003f5c;
    }
    .reservas-dentro button{
        width: 100%;
        padding: 8px;
        margin-top: 20px;
        font-size: 15px;
        border: 2px solid #003f5c;
        border-radius: 50px;
        color: white;
        background-color: #003f5c;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
    }
    .reservas-dentro button:hover{
        background-color: white;
        color: #003f5c;
        border-color: #003f5c;
    }
    .reservas-dentro input {
        width: 40%;
        height: 35px;
        padding: 0 10px;
        font-size: 16px;
        border: 2px solid #009FA8;
        border-radius: 12px;
        background-color: #009FA8;
        color: white;
        box-shadow: 0px 2px 5px rgba(0, 63, 92, 0.1);
        transition: all 0.3s ease-in-out;
    }
    .reservas-dentro input:hover {
        background-color: white;
        border-color: #009FA8;
        color: #009FA8;
    }
    .reservas-dentro input:focus {
        outline: none;
        background-color: #009FA8;
        color: white;
        box-shadow: 0px 4px 8px rgba(0, 63, 92, 0.2);
    }
    .fecha-info{
        display: flex;
        flex-direction: row;
        margin-top: 20px;
        gap: 5px;
    }
    .etiqueta_fecha{
        font-size: 18px;
        font-weight: bold;
        color:#003f5c;
        width: 50%;
        text-align: right;
    }
    .valor_fecha{
        font-size: 18px;
        color: black;
    }
    .reserva-hecha{
        display: flex;
        justify-content: center;
        font-size: 20px;
        color:#003f5c;
        font-weight: bold;
        margin-top: 20px;
    }
    .administrar_resenya{
        display: flex;
        margin-left: auto;
    }
    .cancelar{
        border-radius:50%;
        background-image: url("{{ asset('img/borrar.png') }}");
        background-size:100%;
        background-position: center;
        border:1px solid white;
        width: 35px;
        height: 35px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }
    .cancelar:hover{
        border:1px solid black;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    .flatpickr-calendar {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        border: 2px solid #009FA8;
        border-radius: 12px;
        box-shadow: 0px 4px 8px rgba(0, 63, 92, 0.2);
    }

    .flatpickr-month {
        background-color: #009FA8;
        color: white;
        border-radius: 12px 12px 0 0;
        padding: 10px;
    }

    .flatpickr-weekday {
        color: #003f5c;
        font-weight: bold;
    }

    .flatpickr-day {
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .flatpickr-day:hover {
        background-color: #009FA8;
        color: white;
    }

    .flatpickr-day.today {
        background-color: #003f5c;
        color: white;
        font-weight: bold;
    }

    .flatpickr-day.disabled {
        background-color: #ffe6e6;
        color: red;
        cursor: not-allowed;
    }

    .flatpickr-day.selected {
        background-color: #009FA8;
        color: white;
        font-weight: bold;
    }
    .esMio{
        font-size: 18px;
        font-weight: bold;
        color:#003f5c;
    }
    .mensaje-vacio {
        margin: 30px 0;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        font-size: 18px;
        color: #6c757d;
    }
</style>
@php
    $email = App\Models\User::find($inmueble->propietario)->email;
    $nombre = App\Models\User::find($inmueble->propietario)->nombre;
    $apellidos = App\Models\User::find($inmueble->propietario)->apellidos;
    $telefono = App\Models\User::find($inmueble->propietario)->telefono;
    $ciudad = App\Models\Ciudad::find($inmueble->ciudad)->localidad;
    $pais = App\Models\Ciudad::find($inmueble->ciudad)->pais;
@endphp
@if (session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
<div class="titulo-pagina">
    @if ($inmueble->categoria == 'Casa_rural')
        Casa Rural en {{ $ciudad }}, {{ $pais }}
    @else
        {{ $inmueble->categoria }} en {{ $ciudad }}, {{ $pais }}
    @endif
</div>
<div class="inmueble-info">
    <img src="{{ asset($inmueble->imagen) }}" class="inmueble-imagen">
    <div class="inmueble-info-detalles">
        <div class="inmueble-info-detalles-partes">
            <label class="titulo">Información Básica</label>
            <div class="detalles">
                <label class="etiqueta">Ciudad:</label>
                <label class="valor">{{ $ciudad }}, {{ $pais }}</label>
            </div>
            <div class="detalles">
                <label class="etiqueta">Direccion:</label>
                <label class="valor">{{ $inmueble->direccion }}</label>
            </div>
            <div class="detalles">
                <label class="etiqueta">Categoria:</label>
                @if($inmueble->categoria == 'Casa_rural')
                    <label class="valor">Casa Rural</label>
                @else
                    <label class="valor">{{ $inmueble->categoria }}</label>
                @endif
            </div>
            <div class="detalles">
                <label class="etiqueta">Precio:</label>
                <label class="valor">{{ $inmueble->precio }}€ / Noche</label>
            </div>
        </div>
        <div class="inmueble-info-detalles-partes">
            <label class="titulo">Descripción</label>
            <div class="detalles">
                <label class="valor">{{ $inmueble->descripcion }}</label>
            </div>
        </div>
        <div class="inmueble-info-detalles-partes">
            <label class="titulo">Características</label>
            <div class="detalles">
                <label class="etiqueta">Habitaciones:</label>
                <label class="valor">{{ $inmueble->num_habitaciones }}</label>
            </div>
            <div class="detalles">
                <label class="etiqueta">Superficie:</label>
                <label class="valor">{{ $inmueble->superficie }} m²</label>
            </div>
            <div class="detalles">
                <label class="etiqueta">WiFi:</label>
                <label class="valor">{{ $inmueble->wifi ? 'Sí' : 'No' }}</label>
            </div>
            <div class="detalles">
                <label class="etiqueta">Piscina:</label>
                <label class="valor">{{ $inmueble->piscina ? 'Sí' : 'No' }}</label>
            </div>
        </div>
        <div class="inmueble-info-detalles-partes">
            <label class="titulo">Propietario</label>
            <div class="detalles">
                <label class="etiqueta">Nombre:</label>
                <label class="valor">{{ $nombre }} {{ $apellidos }}</label>
            </div>
            <div class="detalles">
                <label class="etiqueta">Teléfono:</label>
                <label class="valor">{{ $telefono }}</label>
            </div>
            <div class="detalles">
                <label class="etiqueta">Correo:</label>
                <label class="valor">{{ $email }}</label>
            </div>
        </div>
    </div>
</div>
<div class="inmueble-info">
    <div class="resenyas">
        @if ($cantidad_resenyas <= 0)
        <div class="mensaje-vacio">
            Todavía no hay reseñas para este inmueble.
        </div>
        @else
            @if ($mi_resenya)
                @php
                    $nombre = App\Models\User::find($mi_resenya->usuario)->nombre;
                    $apellidos = App\Models\User::find($mi_resenya->usuario)->apellidos;
                    $imagen = App\Models\User::find($mi_resenya->usuario)->imagen;
                @endphp
                <div class="mi-comentario">
                    <div class="comentario-detalles">
                        <img src="{{ asset($imagen) }}" class="resenya-imagen">
                        <label class="comentario-valor">{{ $nombre }}</label>
                        <label class="comentario-valor">{{ $apellidos }}</label>
                        <div class="administrar_resenya">
                            <form action="{{ route('inicio.comentar_cancelar', $mi_resenya->id) }}" method="POST">
                                @csrf
                                <button class="cancelar"></button>
                            </form> 
                        </div>    
                    </div>
                    <div class="comentario-detalles">
                        <label class="comentario-etiqueta">Valoración Inmueble:</label>
                        <div class="comentario-valor">
                            @if ($mi_resenya->valoracion_inmueble == 0)
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                            @elseif ($mi_resenya->valoracion_inmueble == 1)
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                            @elseif ($mi_resenya->valoracion_inmueble == 2)
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                            @elseif ($mi_resenya->valoracion_inmueble == 3)
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                            @elseif ($mi_resenya->valoracion_inmueble == 4)
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                            @elseif ($mi_resenya->valoracion_inmueble == 5)
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                            @endif
                        </div>
                    </div>
                    <div class="comentario-detalles">
                        <label class="comentario-etiqueta">Valoración Propietario:</label>
                        <div class="comentario-valor">
                            @if ($mi_resenya->valoracion_propietario == 0)
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                            @elseif ($mi_resenya->valoracion_propietario == 1)
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                            @elseif ($mi_resenya->valoracion_propietario == 2)
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                            @elseif ($mi_resenya->valoracion_propietario == 3)
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                            @elseif ($mi_resenya->valoracion_propietario == 4)
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                            @elseif ($mi_resenya->valoracion_propietario == 5)
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                <img class="estrella" src="{{ asset('img/estrella.png') }}">
                            @endif
                        </div>
                    </div>
                    <div class="comentario-detalles">
                        <label class="comentario-valor">{{ $mi_resenya->comentario }}</label>
                    </div>
                </div>
            @else
                @if ($user != null && $esMio == false)
                    <form action="{{ route('inicio.comentar', $inmueble->id) }}" class="comentar" method="POST">
                        @csrf
                        <div class="comentario-detalles">
                            <label class="comentario-etiqueta">Valoración Inmueble:</label>
                            <div class="comentar-valor1">
                                <img id="valor-1" class="estrella" src="{{ asset('img/estrella-vacia.png') }}" data-value="1">
                                <img id="valor-2" class="estrella" src="{{ asset('img/estrella-vacia.png') }}" data-value="2">
                                <img id="valor-3" class="estrella" src="{{ asset('img/estrella-vacia.png') }}" data-value="3">
                                <img id="valor-4" class="estrella" src="{{ asset('img/estrella-vacia.png') }}" data-value="4">
                                <img id="valor-5" class="estrella" src="{{ asset('img/estrella-vacia.png') }}" data-value="5">
                            </div>
                            <input type="hidden" name="valoracion_inmueble" id="valoracion_inmueble" value="0">
                        </div>

                        <div class="comentario-detalles">
                            <label class="comentario-etiqueta">Valoración Propietario:</label>
                            <div class="comentar-valor2">
                                <img id="propietario-1" class="estrella" src="{{ asset('img/estrella-vacia.png') }}" data-value="1">
                                <img id="propietario-2" class="estrella" src="{{ asset('img/estrella-vacia.png') }}" data-value="2">
                                <img id="propietario-3" class="estrella" src="{{ asset('img/estrella-vacia.png') }}" data-value="3">
                                <img id="propietario-4" class="estrella" src="{{ asset('img/estrella-vacia.png') }}" data-value="4">
                                <img id="propietario-5" class="estrella" src="{{ asset('img/estrella-vacia.png') }}" data-value="5">
                            </div>
                            <input type="hidden" name="valoracion_propietario" id="valoracion_propietario" value="0">
                        </div>
                        <div class="comentario-detalles">
                            <label class="comentario-etiqueta">Comentario:</label>
                            <textarea class="comentar-comentario" name="comentario" placeholder="Escribe tu comentario aquí..."></textarea>
                        </div>
                        <div class="comentario-boton">
                            <button>Comentar</button>
                        </div>
                    </form>
                @endif
            @endif
            <div class="resenya-dentro">
                @foreach($resenyas as $resenya)
                    @php
                        $nombre = App\Models\User::find($resenya->usuario)->nombre;
                        $apellidos = App\Models\User::find($resenya->usuario)->apellidos;
                        $imagen = App\Models\User::find($resenya->usuario)->imagen;
                    @endphp
                    @if ($resenya->usuario != $user)
                        <div class="comentario">
                            <div class="comentario-detalles">
                                <img src="{{ asset($imagen) }}" class="resenya-imagen">
                                <label class="comentario-valor">{{ $nombre }}</label>
                                <label class="comentario-valor">{{ $apellidos }}</label>
                            </div>
                            <div class="comentario-detalles">
                                <label class="comentario-etiqueta">Valoración Inmueble:</label>
                                <div class="comentario-valor">
                                    @if ($resenya->valoracion_inmueble == 0)
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                    @elseif ($resenya->valoracion_inmueble == 1)
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                    @elseif ($resenya->valoracion_inmueble == 2)
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                    @elseif ($resenya->valoracion_inmueble == 3)
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                    @elseif ($resenya->valoracion_inmueble == 4)
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                    @elseif ($resenya->valoracion_inmueble == 5)
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                    @endif
                                </div>
                            </div>
                            <div class="comentario-detalles">
                                <label class="comentario-etiqueta">Valoración Propietario:</label>
                                <div class="comentario-valor">
                                    @if ($resenya->valoracion_propietario == 0)
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                    @elseif ($resenya->valoracion_propietario == 1)
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                    @elseif ($resenya->valoracion_propietario == 2)
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                    @elseif ($resenya->valoracion_propietario == 3)
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                    @elseif ($resenya->valoracion_propietario == 4)
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella-vacia.png') }}">
                                    @elseif ($resenya->valoracion_propietario == 5)
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                        <img class="estrella" src="{{ asset('img/estrella.png') }}">
                                    @endif
                                </div>
                            </div>
                            <div class="comentario-detalles">
                                <label class="comentario-valor">{{ $resenya->comentario }}</label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
    <div class="reservar">
        <label class="titulo">Reservar</label>
        <div class="reservas-dentro">
            @if($mi_reserva)
                <form action="{{ route('inicio.reservar_cancelar', $mi_reserva->id) }}" method="POST" >
                    @csrf
                    <div class="reserva-hecha">
                        <label>Tu reserva ya está confirmada</label>
                    </div>
                    <div class="fecha-info">
                        <label class="etiqueta_fecha">Fecha Inicio:</label>
                        <label class="valor_fecha">{{ $mi_reserva->fecha_inicio }}</label>
                    </div>
                    <div class="fecha-info">
                        <label class="etiqueta_fecha">Fecha Final:</label>
                        <label class="valor_fecha">{{ $mi_reserva->fecha_fin }}</label>
                    </div>
                    <div class="fecha-info">
                        <label class="etiqueta_fecha">Noches: </label>
                        <label class="valor_fecha">{{ $mi_reserva->dias }}</label>
                        </div>
                    <div class="fecha-info">
                        <label class="etiqueta_fecha">Precio total: </label>
                        <label class="valor_fecha">{{ $mi_reserva->precio_total }} €</label>
                    </div>
                    <div class="fecha-info">
                        <label class="etiqueta_fecha">Estado: </label>
                        <label class="valor_fecha">{{ $mi_reserva->estado }}</label>
                    </div>
                    <button>Cancelar Reserva</button>
                </form>
            @else
                @if($esMio == true)
                    <form action="{{ route('propietario.ver_reservas', $inmueble->id) }}" method="GET">
                        @csrf
                        <div class="fecha-info">
                            <label class="esMio">Este inmueble es tuyo</label>
                        </div>    
                        <div class="fecha-info">
                            <label class="esMio">Reservas: </label>
                            <label class="valor_fecha">{{ $cantidad_reservas}}</label>
                        </div>
                        <button>Ver Reservas</button>
                    </form>
                @else
                    <form action="{{ route('inicio.reservar', $inmueble->id) }}" method="POST" >
                        @csrf
                        <div class="dentro-fecha">
                            <label class="fechas">Fecha de Inicio:</label>
                            <label class="fechas">Fecha de Fin:</label>
                        </div>
                        <div class="dentro-fecha">
                            <input id="fecha_inicio" name="fecha_inicio" data-fechas="{{ implode(',', $fechas) }}" required>
                            <input id="fecha_fin" name="fecha_fin" required>
                        </div>
                        <div class="fecha-info">
                            <label class="etiqueta_fecha">Noches: </label>
                            <label class="valor_fecha" id="dias_totales">0</label>
                            </div>
                        <div class="fecha-info">
                            <label class="etiqueta_fecha">Precio total: </label>
                            <label class="valor_fecha" id="precio_total">0 €</label>
                        </div>
                        <button id="reservar">Reservar</button>
                    </form>
                @endif
            @endif
        </div>
    </div>
</div>   

<script>
   document.addEventListener("DOMContentLoaded", function () {
    const fechaInicio = document.getElementById("fecha_inicio");
    const fechaFin = document.getElementById("fecha_fin");
    const diasTotalesLabel = document.getElementById("dias_totales");
    const precioTotalLabel = document.getElementById("precio_total");
    const precioPorNoche = <?php echo json_encode($inmueble->precio); ?>;
    const fechasNoDisponibles = fechaInicio.getAttribute("data-fechas").split(",");
    const boton = document.getElementById("reservar");
    // Deshabilitar el campo Fecha de Fin inicialmente
    fechaFin.disabled = true;
    fechaFin.style.cursor = "not-allowed";
    boton.disabled = true;
    boton.style.cursor = "not-allowed";
    // Configurar Flatpickr para Fecha de Inicio
    flatpickr("#fecha_inicio", {
        dateFormat: "Y-m-d",
        disable: fechasNoDisponibles,
        minDate: "today",
        locale: {
            firstDayOfWeek: 1
        },
        onChange: function (selectedDates, dateStr) {
            // Habilitar el campo Fecha de Fin cuando se seleccione una fecha de inicio
            fechaFin.disabled = false;
            fechaFin.style.cursor = "pointer";
            // Calcular el maxDate para fecha_fin
            const fechaSeleccionada = new Date(dateStr);
            let maxDate = null;

            for (const fecha of fechasNoDisponibles) {
                if (new Date(fecha) > fechaSeleccionada) {
                    maxDate = new Date(fecha);
                    maxDate.setDate(maxDate.getDate() - 1); // Día anterior al inicio del siguiente rango reservado
                    break;
                }
            }

            const minDate = new Date(fechaSeleccionada);
            minDate.setDate(minDate.getDate() + 1); // Un día después de la fecha seleccionada

            // Si no hay fechas reservadas después de la seleccionada, no establecer maxDate
            fechaFinCalendar.set("minDate", minDate);
            fechaFinCalendar.set("maxDate", maxDate || null);

            // Reiniciar los valores de días y precio total
            diasTotalesLabel.textContent = "0";
            precioTotalLabel.textContent = "0 €";
        }
    });

    // Configurar Flatpickr para Fecha de Fin
    const fechaFinCalendar = flatpickr("#fecha_fin", {
        dateFormat: "Y-m-d",
        disable: fechasNoDisponibles,
        minDate: "today", // Este valor se actualizará dinámicamente
        locale: {
            firstDayOfWeek: 1
        },
        onChange: function (selectedDates, dateStr) {
            // Calcular los días totales y el precio total
            const fechaInicioSeleccionada = new Date(fechaInicio.value);
            const fechaFinSeleccionada = new Date(dateStr);

            const diferenciaTiempo = fechaFinSeleccionada - fechaInicioSeleccionada;
            const diasTotales = Math.ceil(diferenciaTiempo / (1000 * 60 * 60 * 24)); // Convertir milisegundos a días
            boton.disabled = false;
            boton.style.cursor = "pointer";
            // Actualizar los valores en la interfaz
            diasTotalesLabel.textContent = diasTotales;
            precioTotalLabel.textContent = `${diasTotales * precioPorNoche} €`;
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
        // Seleccionar todas las imágenes con la clase "estrella" dentro de "comentar-valor"
        const estrellas = document.querySelectorAll(".comentar-valor1 .estrella");

        estrellas.forEach((estrella, index) => {
            estrella.addEventListener("click", function () {
                // Cambiar las estrellas anteriores y la actual a la imagen llena
                estrellas.forEach((e, i) => {
                    if (i <= index) {
                        e.src = "{{ asset('/img/estrella.png') }}"; // Estrella llena
                    } else {
                        e.src = "{{ asset('/img/estrella-vacia.png') }}"; // Estrella vacía
                    }
                });
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        // Función para manejar las estrellas de valoración
        function manejarEstrellas(claseEstrellas, inputHiddenId) {
            const estrellas = document.querySelectorAll(`.${claseEstrellas} .estrella`);
            const inputHidden = document.getElementById(inputHiddenId);

            estrellas.forEach((estrella, index) => {
                estrella.addEventListener("click", function () {
                    // Si la estrella ya está seleccionada, restablecer todas las estrellas
                    if (inputHidden.value == estrella.getAttribute("data-value")) {
                        estrellas.forEach(e => e.src = "{{ asset('/img/estrella-vacia.png') }}"); // Estrellas vacías
                        inputHidden.value = 0; // Restablecer el valor a 0
                    } else {
                        // Cambiar las estrellas anteriores y la actual a la imagen llena
                        estrellas.forEach((e, i) => {
                            if (i <= index) {
                                e.src = "{{ asset('/img/estrella.png') }}"; // Estrella llena
                            } else {
                                e.src = "{{ asset('/img/estrella-vacia.png') }}"; // Estrella vacía
                            }
                        });

                        // Actualizar el valor del input oculto
                        inputHidden.value = estrella.getAttribute("data-value");
                    }
                });
            });
        }

        // Manejar las estrellas de valoración del inmueble
        manejarEstrellas("comentar-valor1", "valoracion_inmueble");

        // Manejar las estrellas de valoración del propietario
        manejarEstrellas("comentar-valor2", "valoracion_propietario");
    });
</script>

@endsection