@extends('layouts.app')

@section('title', 'Subir Inmueble')

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
        padding: 25px;
        border: 3px solid #003f5c;
        border-radius: 12px;
        background-color: white;
    }
    .titulo {
        color: #003f5c;
        text-align: center;
        font-size: 35px;
        font-weight: bold;
        margin-bottom: 30px;
    }
    .subir-info {
        display: flex;
        flex-direction: column;
        width: 80%;
        min-height: 300px;
        align-items: center;
    }
    .subir-formulario {
        display: flex;
        flex-direction: column;
        width: 70%;
        align-items: center;
        gap: 15px;
    }
    .subir-formulario-detalles {
        display: flex;
        flex-direction: row;
        gap: 15px;
    }
    .subir-formulario-detalles label {
        width: 150px;
        font-size: 18px;
        font-weight: bold;
        text-align: right;
        color: #003f5c;
    }
    .subir-formulario-detalles input {
        width: 320px;
        height: 20px;
        border-radius: 10px;
        border: 2px solid #003f5c;
        background-color: white;
        box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.2);
        padding: 5px;
    }
    .subir-formulario-detalles select {
        width: 335px;
        height: 35px;
        border-radius: 10px;
        border: 2px solid #003f5c;
        box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.2);
        background-color: white;
        padding: 5px;
        cursor: pointer;
    }
    .subir-formulario button {
        background-color: #003f5c;
        color: white;
        border: 2px solid #003f5c;
        border-radius: 50px;
        font-size: 15px;
        font-weight: bold;
        padding: 8px 18px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        box-shadow: 0px 0px 7px 7px rgba(0, 0, 0, 0.2);

    }
    .subir-formulario button:hover {
        background-color: white;
        color: #003f5c;
        border: 2px solid #003f5c;
    }
    .descripcion {
        resize: none;
        width: 325px;
        height: 50px;
        border: 2px solid #003f5c;
        border-radius: 10px;
        box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.2);
        padding: 5px;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
@if (count($errors) > 0)
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
@endif
<div class="titulo">SUBIR INMUEBLE</div>
<div class="subir-info">
    <form method="POST" enctype="multipart/form-data" action="{{ route('perfil.insertar_inmueble', $usuario->id) }}" class="subir-formulario">
        @csrf
        <div class="subir-formulario-detalles">
            <label>DIRECCION</label>
            <input type="text" name="direccion" value="{{ old('direccion') }}" required>
        </div>
        <div class="subir-formulario-detalles">
            <label>HABITACIONES</label>
            <input type="number" name="habitaciones" value="{{ old('habitaciones') }}" required>
        </div>
        <div class="subir-formulario-detalles">
            <label>SUPERFICIE</label>
            <input type="number" name="superficie" value="{{ old('superficie') }}" required>
        </div>
        <div class="subir-formulario-detalles">
            <label>CATEGORIA</label>
            <select name="categoria" required>
                <option value="" {{ old('categoria') == '' ? 'selected' : '' }} selected></option>
                <option value="Piso" {{ old('categoria') == 'Piso' ? 'selected' : '' }}>Piso</option>
                <option value="Casa" {{ old('categoria') == 'Casa' ? 'selected' : '' }}>Casa</option>
                <option value="Apartamento" {{ old('categoria') == 'Apartamento' ? 'selected' : '' }}>Apartamento</option>
                <option value="Estudio" {{ old('categoria') == 'Estudio' ? 'selected' : '' }}>Estudio</option>
                <option value="Chalet" {{ old('categoria') == 'Chalet' ? 'selected' : '' }}>Chalet</option>
                <option value="Duplex" {{ old('categoria') == 'Duplex' ? 'selected' : '' }}>Dúplex</option>
                <option value="Villa" {{ old('categoria') == 'Villa' ? 'selected' : '' }}>Villa</option>
                <option value="Casa_rural" {{ old('categoria') == 'Casa_rural' ? 'selected' : '' }}>Casa Rural</option>
                <option value="Loft" {{ old('categoria') == 'Loft' ? 'selected' : '' }}>Loft</option>
                <option value="Adosado" {{ old('categoria') == 'Adosado' ? 'selected' : '' }}>Adosado</option>
            </select>
        </div>
        <div class="subir-formulario-detalles">
            <label>PRECIO/NOCHE</label>
            <input type="number" name="precio" value="{{ old('precio') }}" required>
        </div>
        <div class="subir-formulario-detalles">
            <label>IMAGEN</label>
            <input type="file" name="imagen">
        </div>
        <div class="subir-formulario-detalles">
            <label>DESCRIPCION</label>
            <textarea class="descripcion" name="descripcion" required>{{ old('descripcion') }}</textarea>
        </div>
        <div class="subir-formulario-detalles">
            <label>WIFI</label>
            <select name="wifi" required>
                <option value="" {{ old('wifi') == '' ? 'selected' : '' }} selected></option>
                <option value="1" {{ old('wifi') == '1' ? 'selected' : '' }}>Si</option>
                <option value="0" {{ old('wifi') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="subir-formulario-detalles">
            <label>PISCINA</label>
            <select name="piscina" required>
                <option value="" {{ old('piscina') == '' ? 'selected' : '' }} selected></option>
                <option value="1" {{ old('piscina') == '1' ? 'selected' : '' }}>Si</option>
                <option value="0" {{ old('piscina') == '0' ? 'selected' : '' }}>No</option>
            </select>        </div>
        <div class="subir-formulario-detalles">
            <label>CIUDAD</label>
            <select name="ciudad" required>
                <option value="" {{ old('ciudad') == '' ? 'selected' : '' }} selected></option>
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}" {{ old('ciudad') == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->localidad }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Subir</button>
    </form>
</div>
@endsection