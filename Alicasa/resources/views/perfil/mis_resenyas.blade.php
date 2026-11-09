@extends('layouts.app')

@section('title', 'Mis Reseñas')

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
    .resenya{
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
    .valoraciones {
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
    .valoracion_inmueble{
        display: flex;
        font-size: 20px;
        color: #003f5c;
        margin-bottom: 5px;
    }
    .valoracion_inmueble label{
        width: 210px;
    }
    .valoracion_propietario{
        display: flex;
        font-size: 20px;
        color: #003f5c;
        margin-bottom: 10px;
    }
    .valoracion_propietario label{
        width: 210px;
    }
    .comentario{
        color:rgb(90, 90, 90);
        font-style: italic;
        margin-bottom: 15px;
        line-height: 1.4;
    }
    .fecha_resenya {
        color:rgb(138, 138, 138);
        font-size: 14px;
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
    .icono-estrellas {
        color: #FFD700;
        font-size: 18px;
        margin-left: 5px;
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
    MIS RESEÑAS
</div>

@if(count($resenyas) > 0)
    @foreach ($resenyas as $resenya)
        <div class="resenya">
            @php
                // Cargar el inmueble completo usando el ID
                $inmuebleId = is_object($resenya->inmueble) ? $resenya->inmueble->id : $resenya->inmueble;
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
            
            <div class="valoraciones">
                <div class="titulo-inmueble">
                @if($inmueble->categoria == "Casa_rural")
                    <label for="ciudad" class="ciudad">Casa Rural en {{$ciudad}}</label>
                @else
                    <label for="ciudad" class="ciudad">{{$categoria}} en {{$ciudad}}</label>
                @endif
                </div>
                
                <div class="valoracion_inmueble">
                    <label>Valoración Inmueble:</label>
                    <span class="icono-estrellas">
                        @for($i = 0; $i < $resenya->valoracion_inmueble; $i++)
                            <img src="{{ asset('img/estrella.png') }}" alt="Estrella" style="width: 18px; height: 18px;">
                        @endfor
                        @for($i = $resenya->valoracion_inmueble; $i < 5; $i++)
                            <img src="{{ asset('img/estrella-vacia.png') }}" alt="Estrella" style="width: 18px; height: 18px;">
                        @endfor
                    </span>
                </div>
                
                <div class="valoracion_propietario">
                    <label>Valoración Propietario:</label>
                    <span class="icono-estrellas">
                        @for($i = 0; $i < $resenya->valoracion_propietario; $i++)
                            <img src="{{ asset('img/estrella.png') }}" alt="Estrella" style="width: 18px; height: 18px;">
                        @endfor
                        @for($i = $resenya->valoracion_propietario; $i < 5; $i++)
                            <img src="{{ asset('img/estrella-vacia.png') }}" alt="Estrella" style="width: 18px; height: 18px;">
                        @endfor
                    </span>
                </div>
                
                <div class="comentario">
                    @if($resenya->comentario != null)
                        "{{ $resenya->comentario }}"
                    @endif
                </div>
                
                @if(isset($resenya->created_at))
                    <div class="fecha_resenya">
                        Publicada el {{ $resenya->created_at->format('d/m/Y') }}
                    </div>
                @endif
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