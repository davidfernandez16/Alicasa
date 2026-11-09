@extends('layouts.app')

@section('title', 'Inicio')

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
    .inmueble{
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
    .inmueble img{
        width: 200px;
        height: 200px;
        border: 5px solid #003f5c;
        border-radius: 25px;
        object-fit: cover;
    }
    .informacion {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 10px;
        margin-left: 10px;
        width: 50%;
        height: 180px;
        
    }
    .ciudad{
        font-size: 28px;
        font-weight: bold;
        color: #003f5c;
    }
    .direccion{
        color:rgb(138, 138, 138);
    }
    .precio{
        font-size: 20px;
        font-weight: bold;
        color: #003f5c;
    }
    .descripcion{
        color:rgb(138, 138, 138);
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
    }
    .ver_inmueble:hover {
        background-color: white;
        color: #003f5c;
        border-color:#003f5c;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>

@include('inicio.filtrar')


<label class="titulo">INMUEBLES DISPONIBLES</label>
@foreach ($inmuebles as $inmueble)

@php
    $nombre = App\Models\User::find($inmueble->propietario)->nombre;
    $ciudad = App\Models\Ciudad::find($inmueble->ciudad)->localidad;
    $provincia = App\Models\Ciudad::find($inmueble->ciudad)->provincia;
@endphp

<form action="{{ route('inicio.inmueble', $inmueble->id) }}" target="_blank" method="GET">
    <div class="inmueble">
        @csrf
        <img src="{{ asset($inmueble->imagen) }}">
        <div class="informacion">
            @if($inmueble->categoria == "Casa_rural")
                <label for="nombre" class="ciudad">Casa Rural en {{$ciudad}}</label>
            @else
                <label for="ciudad" class="ciudad">{{$inmueble->categoria}} en {{$ciudad}}</label>
            @endif
            <label for="direccion" class="direccion">{{$inmueble->direccion}}, {{$ciudad}} ({{$provincia}})</label>
            <label for="descripcion" class="descripcion">
                {{ $inmueble->num_habitaciones }} 
                @if ($inmueble->num_habitaciones == 1)
                    habitación
                @else
                    habitaciones
                @endif
            </label>                
            <label for="superficie" class="descripcion">{{$inmueble->superficie}} m²</label>
            <label for="precio" class="precio">{{$inmueble->precio}}€ Noche </label>
        </div>
        <button class="ver_inmueble" type="submit">Ver Inmueble</button>
    </div>
</form>

@endforeach
@endsection