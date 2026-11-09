@extends('layouts.app')

@section('title', 'Mis Inmuebles')

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
        padding: 20px;
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


    <div class="titulo">MIS INMUEBLES</div>

    @forelse($inmuebles as $inmueble)
        @php
            // Obtengo manualmente la ciudad
            $ciudad = App\Models\Ciudad::find($inmueble->ciudad);
        @endphp
        <form action="{{ route('inicio.inmueble', $inmueble->id) }}" target="_blank" method="GET">
            <div class="inmueble">
                @csrf
                <img src="{{ asset($inmueble->imagen) }}" alt="Imagen de {{ $inmueble->categoria }}">
                <div class="informacion">
                    <label class="ciudad">
                        {{ $inmueble->categoria === 'Casa_rural' ? 'Casa Rural' : $inmueble->categoria }} en {{ $ciudad->localidad }}
                    </label>
                    <label class="direccion">
                        {{ $inmueble->direccion }}, {{ $ciudad->localidad }} ({{ $ciudad->provincia }})
                    </label>
                    <label class="descripcion">
                        {{ $inmueble->num_habitaciones }} {{ Str::plural('habitación', $inmueble->num_habitaciones) }}
                    </label>
                    <label class="descripcion">
                        {{ $inmueble->superficie }} m²
                    </label>
                    <label class="precio">
                        {{ $inmueble->precio }}€ Noche
                    </label>
                </div>
                <button class="ver_inmueble" type="submit">Ver Inmueble</button>
            </div>
        </form>
    @empty
        <p>No tienes inmuebles registrados aún.</p>
    @endforelse

@endsection
