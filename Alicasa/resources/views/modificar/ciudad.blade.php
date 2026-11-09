@extends('layouts.app')

@section('title', 'Modificar Ciudad')

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
            font-family: "arial";
            border: 1px solid #000;
            border-radius: 10px;
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
        Modificar Ciudad {{ $ciudad->id }}
        <button type="button" onclick="window.location='{{ url()->previous() }}'" class="boton2">Volver</button>
    </div>

    @if (count($errors) > 0)
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif

    <form action="{{ route('ciudad.modificar', $ciudad->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="casilla">
            <label for="codigo_postal">CÓDIGO POSTAL</label>
            <input type="text" name="codigo_postal" id="codigo_postal" placeholder="{{ $ciudad->codigo_postal }}">
        </div>
        <div class="casilla">
            <label for="localidad">LOCALIDAD</label>
            <input type="text" name="localidad" id="localidad" placeholder="{{ $ciudad->localidad }}">
        </div>
        <div class="casilla">
            <label for="provincia">PROVINCIA</label>
            <input type="text" name="provincia" id="provincia" placeholder="{{ $ciudad->provincia }}">
        </div>
        <div class="casilla">
            <label for="pais">PAÍS</label>
            <input type="text" name="pais" id="pais" placeholder="{{ $ciudad->pais }}">
        </div>
        <button type="submit" class="boton3">Modificar</button>
    </form>
@endsection
