@extends('layouts.app')

@section('title', 'Administrador')

@section('content')
<style>
    body{
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        background-attachment: fixed;
    }
    .container {
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
        color:#009FA8;
        text-align: center;
        font-size: 35px;
        font-weight: bold;
    }
    h2{
        margin-top:0px;
        color: #009FA8; 
    }
    .ver{
        font-family: "arial";
        width: 50%;
        margin: 20px auto 20px;
        padding: 15px;
        background-color: white;
        border: 3px solid #003f5c;
        border-radius: 12px;
        box-shadow: 0px 0px 15px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .boton2 {
        padding: 10px 20px;
        font-size: 16px;
        background-color: white;
        border: 2px solid #003f5c;
        color: #003f5c;
        border-radius: 50px;
        width: 160px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
    }
    .boton2:hover {
        background-color: #009FA8;
        color: white;
        border-color:#009FA8;
        transform: scale(1.05);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>
    <div class="titulo">
        ADMINISTRACION
    </div>

    {{-- Tabla de Usuarios --}}
    
    <div class="ver">
        <h2>USUARIOS</h2>
        <form action="{{ route('ver.user') }}" method="GET" style="display:inline;">
            @csrf
            <button class="boton2" type="submit">Ver Usuarios</button>
        </form>
    </div>
    {{-- Tabla de Inmuebles --}}

    <div class="ver">
        <h2>INMUEBLES</h2>
        <form action="{{ route('ver.inmueble') }}" method="GET" style="display:inline;">
            @csrf
            <button class="boton2" type="submit">Ver Inmuebles</button>
        </form>
    </div>
    {{-- Tabla de Reservas --}}

    <div class="ver">
    <h2>RESERVAS</h2>
        <form action="{{ route('ver.reserva') }}" method="GET" style="display:inline;">
            @csrf
            <button class="boton2" type="submit">Ver Reservas</button>
        </form>
    </div>
    {{-- Tabla de Reseñas --}}

    <div class="ver">
        <h2>RESEÑAS</h2>
        <form action="{{ route('ver.resenya') }}" method="GET" style="display:inline;">
            @csrf
            <button class="boton2" type="submit">Ver Reseñas</button>
        </form>
    </div>
    {{-- Tabla de Ciudades --}}
    
    <div class="ver">
        <h2>CIUDADES</h2>
        <form action="{{ route('ver.ciudad') }}" method="GET" style="display:inline;">
            @csrf
            <button class="boton2" type="submit">Ver Ciudades</button>
        </form>
    </div>
@endsection