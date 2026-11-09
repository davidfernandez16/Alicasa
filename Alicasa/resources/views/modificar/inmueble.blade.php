@extends('layouts.app')

@section('title', 'Modificar Inmueble')

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
        .casilla input,textarea {
            width: 35%;
            padding: 5px;
            font-size: 14px;
            font-family: "arial";
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
        Modificar Inmueble {{$inmueble->id}}
        <button type="button" onclick="window.location='{{ url()->previous() }}'" class="boton2">Volver</button>
    </div>
    @if (count($errors) > 0)
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif
    <form action="{{ route('inmueble.modificar', $inmueble->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="casilla">
            <label for="direccion">DIRECCION</label>
            <input type="text" name="direccion" id="direccion" placeholder="{{ $inmueble->direccion }}">
        </div>
        <div class="casilla">
            <label for="num_habitaciones">Nº DE HABITACIONES</label>
            <input type="text" name="num_habitaciones" id="num_num_habitacioneshab" placeholder="{{ $inmueble->num_habitaciones }}">
        </div>
        <div class="casilla">
            <label for="superficie">SUPERFICIE</label>
            <input type="text" name="superficie" id="superficie" placeholder="{{ $inmueble->superficie }}">
        </div>
        <div class="casilla">
            <label for="categoria">CATEGORIA</label>
            <select name="categoria">
                <option value=""></option>
                <option value="Piso" {{ $inmueble->categoria == 'Piso' ? 'selected' : '' }}>Piso</option>
                <option value="Casa" {{ $inmueble->categoria == 'Casa' ? 'selected' : '' }}>Casa</option>
                <option value="Apartamento" {{ $inmueble->categoria == 'Apartamento' ? 'selected' : '' }}>Apartamento</option>
                <option value="Estudio" {{ $inmueble->categoria == 'Estudio' ? 'selected' : '' }}>Estudio</option>
                <option value="Chalet" {{ $inmueble->categoria == 'Chalet' ? 'selected' : '' }}>Chalet</option>
                <option value="Duplex" {{ $inmueble->categoria == 'Duplex' ? 'selected' : '' }}>Dúplex</option>
                <option value="Villa" {{ $inmueble->categoria == 'Villa' ? 'selected' : '' }}>Villa</option>
                <option value="Casa_rural" {{ $inmueble->categoria == 'Casa_rural' ? 'selected' : '' }}>Casa Rural</option>
                <option value="Loft" {{ $inmueble->categoria == 'Loft' ? 'selected' : '' }}>Loft</option>
                <option value="Adosado" {{ $inmueble->categoria == 'Adosado' ? 'selected' : '' }}>Adosado</option>
            </select>
        </div>

        <div class="casilla">
            <label for="precio">PRECIO/NOCHE</label>
            <input type="number" name="precio" id="precio" placeholder="{{ $inmueble->precio }}">
        </div>
        <div class="casilla">
            <label for="imagen">IMAGEN</label>
            <input type="file" name="imagen" id="imagen">
        </div>
        <div class="casilla">
            <label for="descripcion">DESCRIPCION</label>
            <textarea name="descripcion" id="descripcion" placeholder="{{ $inmueble->descripcion }}"></textarea>
        </div>
        <div class="casilla">
            <label for="wifi">WIFI</label>
            <select name="wifi">
                <option value=""></option>
                <option value="1" {{ $inmueble->wifi == '1' ? 'selected' : '' }}>Si</option>
                <option value="0" {{ $inmueble->wifi == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="casilla">
            <label for="piscina">PISCINA</label>
            <select name="piscina">
                <option value=""></option>
                <option value="1" {{ $inmueble->piscina == '1' ? 'selected' : '' }}>Si</option>
                <option value="0" {{ $inmueble->piscina == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="casilla">
            <label for="ciudad">CIUDAD</label>
            <select name="ciudad">
                <option value="" selected></option>
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}" {{ $inmueble->ciudad == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->localidad }}</option>
                @endforeach
            </select>
        </div>
        <div class="casilla">
            <label for="propietario">PROPIETARIO</label>
            <select name="propietario" >
                <option value="" selected></option>
                @foreach ($propietarios as $propietario)
                <option value="{{ $propietario->id }}" {{ $inmueble->propietario == $propietario->id ? 'selected' : '' }}>{{ $propietario->nombre }} {{ $propietario->apellidos }}</option>
            @endforeach
            </select>
        </div>
        <button type="submit" class="boton3">Modificar</button>
    </form>
@endsection