@extends('layouts.app')

@section('title', 'Mis Reservas')

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
    .titulo{
        color:#003f5c;
        text-align: center;
        font-size: 35px;
        font-weight: bold;
        margin-top:50px;
        margin-bottom: 50px;
    }
    .reserva{
        display:flex;
        flex-direction: row;
        padding: 20px 20px;
        margin-bottom: 20px;
        gap:10px;
        border:2px solid #003f5c;
        border-radius: 25px;
        background-color: white;
        box-shadow: 0px 0px 15px 10px rgba(0, 0, 0, 0.1);
        align-items: center;
        justify-content: center;
        width: 800px;
    }
    .reserva_info {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 10px;
        margin-left: 10px;
        width: 50%;
        height: 180px;
    }
    .titulo-inmueble {
        font-size: 28px;
        font-weight: bold;
        color: #003f5c;
        margin-bottom: 10px;
    }
    .fechas-reserva {
        display: flex;
        flex-direction: row;
        gap: 10px;
        align-items: center;
    }
    .fechas-reserva label {
        width: 150px;
        font-size: 16px;
        color:#003f5c;
        font-weight: bold;
    }
    .ver_inmueble {
        padding: 10px 20px;
        font-size: 15px;
        font-weight: bold;
        background-color: #003f5c;
        border: 2px solid #003f5c;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        height: fit-content;
        color: white;
        text-decoration: none;
    }
    .ver_inmueble:hover {
        background-color: white;
        color: #003f5c;
        border-color:#003f5c;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    .mensaje-vacio {
        margin: 30px 0;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        font-size: 18px;
        color: #6c757d;
    }
    .imagen-inmueble {
        width: 200px;
        height: 200px;
        border: 5px solid #003f5c;
        border-radius: 25px;
        object-fit: cover;
    }
</style>

<div class="titulo">
    MIS RESERVAS
</div>

@if(count($reservas) > 0)
@foreach ($reservas as $reserva)
    <div class="reserva">
        @php
            // Cargar el inmueble completo usando el ID
            $inmuebleId = is_object($reserva->inmueble) ? $reserva->inmueble->id : $reserva->inmueble;
            $inmueble = App\Models\Inmueble::find($inmuebleId);
            
            // Verificar si tenemos un inmueble válido
            if ($inmueble) {
                $ciudad = App\Models\Ciudad::find($inmueble->ciudad)->localidad ?? 'Ciudad no disponible';
                $provincia = App\Models\Ciudad::find($inmueble->ciudad)->provincia ?? 'Provincia no disponible';
                $categoria = $inmueble->categoria ?? 'Alojamiento';
                $imagen = $inmueble->imagen;
            } else {
                $ciudad = 'Ciudad no disponible';
                $provincia = 'Provincia no disponible';
                $categoria = 'Alojamiento';
                $imagen = 'images/default-property.jpg';
            }
        @endphp
        
        <img src="{{ asset($imagen) }}" class="imagen-inmueble">
        
        <div class="reserva_info">
            <div class="titulo-inmueble">
                @if($inmueble->categoria == "Casa_rural")
                    <label for="ciudad">Casa Rural en {{$ciudad}}</label>
                @else
                    <label for="ciudad">{{$categoria}} en {{$ciudad}}</label>
                @endif
            </div>
            
            <div class="fechas-reserva">
                <label>Fecha de entrada:</label>
                <span>{{ date('d/m/Y', strtotime($reserva->fecha_inicio)) }}</span>
            </div>
            
            <div class="fechas-reserva">
                <label>Fecha de salida:</label>
                <span>{{ date('d/m/Y', strtotime($reserva->fecha_fin)) }}</span>
            </div>
            
            <div class="fechas-reserva">
                <label>Días reservados:</label>
                <span>{{ $reserva->dias }}</span>
            </div>
            
            <div class="fechas-reserva">
                <label>Precio total:</label>
                <span>{{ number_format($reserva->precio_total, 2) }} €</span>
            </div>
            <div class="fechas-reserva">
                <label>Estado:</label>
                <span>{{ $reserva->estado }}</span>
            </div>
        </div>
        
        <a href="{{ route('inicio.inmueble', $inmuebleId) }}" target="_blank" class="ver_inmueble">
            Ver inmueble
        </a>
    </div>
@endforeach
@else
    <div class="mensaje-vacio">
        No has realizado ninguna reseña todavía.
    </div>
@endif
@endsection