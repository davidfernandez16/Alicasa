@extends('layouts.app')

@section('title', 'Insertar Reserva')

@section('content')
    <style>
        .container {
            font-family: "arial";
            width: 80%;
            margin: 80px auto 20px;
            padding: 20px;
            background: white;
            border: 1px solid black;
            border-radius: 8px;
            min-height: 300px;
            text-align: center;
        }
        .titulo {
            color: #009FA8;
            text-align: center;
            font-size: 35px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .casilla {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            margin-right: 17%;
            padding-bottom: 10px;
        }
        .casilla label {
            width: 20%;
            text-align: right;
            padding-right: 10px;
            font-weight: bold;
        }
        .casilla input {
            width: 35%;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #000;
            border-radius: 10px;
        }
        .casilla select {
            width: 36%;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #000;
            border-radius: 10px;
            background-color: white;
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
        }

        .boton2:hover {
            background-color: #009FA8;
            color: white;
            border-color:#009FA8;
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .boton3 {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: white;
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .boton3:hover {
            background-color: #009FA8;
            color: white;
            border-color:#009FA8;
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
    <div class="titulo">
        Insertar Reserva
        <form action="{{ route('ver.reserva') }}" method="GET" style="display:inline;">
            @csrf
            <button class="boton2" type="submit">Volver</button>
        </form>
    </div>
    @if (count($errors) > 0)
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif
    <form action="{{ route('reserva.insertar') }}" method="POST">
        @csrf
        <div class="casilla">
            <label for="fecha_inicio">FECHA INICIO</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio">
        </div>
        <div class="casilla">
            <label for="fecha_fin">FECHA FIN</label>
            <input type="date" name="fecha_fin" id="fecha_fin">
        </div>
        <div class="casilla">
            <label for="estado">ESTADO</label>
            <select name="estado">
                <option value="" selected></option>
                <option value="Pendiente">Pendiente</option>
                <option value="Aceptada">Aceptada</option>
                <option value="Cancelada">Cancelada</option>
            </select>
        </div>
        <div class="casilla">
            <label for="usuario">USUARIO</label>
            <select name="usuario" >
                <option value="" selected></option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }} {{ $usuario->apellidos }}</option>
                @endforeach
            </select>
        </div>
        <div class="casilla">
            <label for="inmueble">INMUEBLE</label>
            <select name="inmueble" >
                <option value="" selected></option>
                @foreach ($inmuebles as $inmueble)
                    <option value="{{ $inmueble->id }}">{{ $inmueble->id }} - {{ $inmueble->direccion }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="boton3">Insertar</button>
    </form>
@endsection