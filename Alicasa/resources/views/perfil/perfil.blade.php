@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
<style>
    body{
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        background-attachment: fixed;
    }
    .container{
        display: flex;
        flex-direction: column;
        width: 80%;
        min-height: 300px;
        margin: 80px auto 20px;
        padding: 30px;
        background-color: white;
        border: 3px solid #003f5c;
        border-radius: 12px;
        box-shadow: 0px 0px 15px 10px rgba(0, 0, 0, 0.1);
        align-items: center;
        font-family: Arial, Helvetica, sans-serif;
    }
    .titulo {
        color: #003f5c;
        text-align: center;
        font-size: 35px;
        font-weight: bold;
        margin-bottom: 30px;
    }
    .perfil-detalles{
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 80%;
        padding: 20px;
        gap: 20px;
    }
    .perfil-imagen{
        width: 200px;
        height: 200px;
        border: 5px solid #003f5c;
        border-radius: 50%;
        cursor: pointer;
    }
    .perfil-info{
        display: flex;
        flex-direction: column;
        width: 60%;
        align-items: center;
        gap: 15px;
    }
    .perfil-info-detalles{
        display: flex;
        flex-direction: row;
        width: 100%;
        align-items: center;
        justify-content: center;
        gap: 10px
    }
    .perfil-info-detalles label{
        font-size: 20px;
        font-weight: bold;
        color: #003f5c;
        width: 30%;
        text-align: right;
    }
    .perfil-info-detalles input{
        border: 2px solid white;
        border-radius: 5px;
        background-color: white;
        font-size: 15px;
        color: black;
    }
    .perfil-ajustes{
        display: flex;
        flex-direction: row;
        width: 40%;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .perfil-boton{
        border: 2px solid #003f5c;
        border-radius: 50px;
        background-color: #003f5c;
        color: white;
        padding: 10px 20px;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }
    .perfil-boton:hover{
        background-color: white;
        border: #003f5c 2px solid;
        color: #003f5c;
    }
</style>

<div class="titulo">PERFIL</div>

<div class="perfil-detalles">
    
    @php
        $rol = '';
        if($usuario->administrador){
            $rol = 'Administrador';
        } elseif($usuario->propietario){
            $rol = 'Propietario';
        } else {
            $rol = 'Cliente';
        }
    @endphp
    @if (count($errors) > 0)
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif
    <form method="GET" action="{{ route('perfil.editar_perfil', $usuario->id) }}" class="perfil-info">
        @csrf
        @method('PUT')
        <img onclick="error()" src="{{ asset($usuario->imagen) }}" class="perfil-imagen">
        <div class="perfil-info-detalles">
            <label>EMAIL:</label>
            <input name="email" type="text" value="{{ $usuario->email }}" disabled>
        </div>
        <div class="perfil-info-detalles">
            <label>NOMBRE:</label>
            <input name="nombre" type="text" value="{{ $usuario->nombre }}" disabled>
        </div>
        <div class="perfil-info-detalles">
            <label>APELLIDOS:</label>
            <input name="apellidos" type="text" value="{{ $usuario->apellidos }}" disabled>
        </div>
        <div class="perfil-info-detalles">
            <label>TELEFONO:</label>
            <input name="telefono" type="text" value="{{ $usuario->telefono }}" disabled>
        </div>
        <div class="perfil-info-detalles">
            <label>ROL:</label>
            <input id="rol" type="text" value="{{ $rol }}" disabled>
        </div>
       <button id="confirmar" type="submit" class="perfil-boton" hidden>Confirmar</button>
    </form>
    <div id="perfil-ajustes" class="perfil-ajustes">
        
        <button id="editar" type="submit" onclick="editar()" class="perfil-boton">Editar</button>
        @if ($rol=='Propietario')
            <form method="GET" action="{{ route('propietario.mis_inmuebles', $usuario->id) }}" style="display:inline">
                @csrf
                <button id="mis_inmuebles" type="submit" class="perfil-boton">Mis Inmuebles</button>
            </form>
            <form method="GET" action="{{ route('perfil.subir_inmueble', $usuario->id) }}" style="display:inline">
                @csrf
                <button id="subir_inmueble" type="submit" class="perfil-boton">Subir Inmueble</button>
            </form>
        @elseif ($rol=='Cliente')
            <form method="GET" action="{{ route('perfil.subir_inmueble', $usuario->id) }}" style="display:inline">
                @csrf
                <button id="subir_inmueble" type="submit" class="perfil-boton">Subir Inmueble</button>
            </form>
        @elseif ($rol=='Administrador')
            <form method="GET" action="{{ route('admin') }}" style="display:inline">
                @csrf
                <button id="admin" type="submit" class="perfil-boton">Administracion</button>
            </form>
        @endif
        <button id="confirmar-externo" type="submit" class="perfil-boton" hidden>Confirmar</button>
        <button id="cancelar" type="submit" onclick="cancelar()" class="perfil-boton" hidden>Cancelar</button>
    </div>
    <div class="perfil-ajustes">
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button id="cerrar_sesion" type="submit" class="perfil-boton">Cerrar sesión</button>
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const botonExterno = document.getElementById("confirmar-externo");
        const botonOculto = document.getElementById("confirmar");
        botonExterno.addEventListener("click", function () {
            botonOculto.click();
        });
    });
    function error() {
        alert("Proximamente disponible");
    }
    function editar() {
        const inputs = document.querySelectorAll("input");
        const cerrar_sesion = document.getElementById("cerrar_sesion");
        const editar = document.getElementById("editar");
        const rol = <?php echo json_encode($rol); ?>;
        const mis_inmuebles = document.getElementById("mis_inmuebles");
        const subir_inmueble = document.getElementById("subir_inmueble");
        const confirmar_externo = document.getElementById("confirmar-externo");
        const cancelar = document.getElementById("cancelar");
        const admin = document.getElementById("admin");
        cerrar_sesion.hidden = true;
        editar.hidden = true;
        confirmar_externo.hidden = false;
        cancelar.hidden = false;
        if(rol == 'Propietario'){
            mis_inmuebles.hidden = true;
            subir_inmueble.hidden = true;
        }
        else if(rol == 'Cliente'){
            subir_inmueble.hidden = true;
        }
        else if(rol == 'Administrador'){
            admin.hidden = true;
        }
        inputs.forEach(input=> {
            if(input.id == "rol"){
                input.disabled = true;
                return;
            }
            input.disabled = !input.disabled;
            input.style.border = "2px solid #003f5c";
            input.placeholder = input.value;
            input.value = "";
        });
    }
    function cancelar() {
        const inputs = document.querySelectorAll("input");
        const cerrar_sesion = document.getElementById("cerrar_sesion");
        const editar = document.getElementById("editar");
        const rol = <?php echo json_encode($rol); ?>;
        const mis_inmuebles = document.getElementById("mis_inmuebles");
        const subir_inmueble = document.getElementById("subir_inmueble");
        const confirmar_externo = document.getElementById("confirmar-externo");
        const cancelar = document.getElementById("cancelar");
        cerrar_sesion.hidden = false;
        editar.hidden = false;
        if(rol == 'Propietario'){
            mis_inmuebles.hidden = false;
            subir_inmueble.hidden = false;

        }
        else if(rol == 'Cliente'){
            subir_inmueble.hidden = false;
        }
        else if(rol == 'Administrador'){
            admin.hidden = false;
        }
        confirmar_externo.hidden = true;
        cancelar.hidden = true;
        inputs.forEach(input=> {
            if(input.id == "rol"){
                input.disabled = true;
                return;
            }
            input.disabled = !input.disabled;
            input.style.border = "2px solid white";
            input.value = input.placeholder;
            input.placeholder = "";
        });
    }
</script>

@endsection