<!-- resources/views/partials/navbar.blade.php -->
<nav id="barra" class="barra">
    <a href="{{ route('inicio') }}" class="alicasa"></a>
    <h1>ALICASA</h1>
    @guest
        <div class="sin_registrar">
            <a href="{{ route('register') }}" class="boton">Registrar</a>
            <a href="{{ route('login') }}" class="boton">Iniciar sesión</a>
        </div>
    @endguest

    @auth
        <div class="registrado">
        </div>
        <img src="{{ asset(Auth::user()->imagen) }}" class="perfil" alt="Tu perfil">
        <button onclick="mostrarMenu()" class="menu">≡</button>
    @endauth
</nav>
@auth
<div id="barrita-menu" class="barrita-menu">
    <a href="{{ route('mis_reservas') }}" class="boton-menu">Mis Reservas</a>
    <div class="linea"></div>
    <a href="{{ route('mis_resenyas') }}" class="boton-menu">Mis Reseñas</a>
    <div class="linea"></div>
    <a href="{{ route('inicio.buscar') }}" class="boton-menu">Buscar</a>
    <div class="linea"></div>
    <a href="{{ route('perfil') }}" class="boton-menu">Perfil</a>
</div>
@endauth
<style>
    body {
        overflow-y: scroll;
    }
    
    .barra {
        font-family: Arial, Helvetica, sans-serif;
        background-color: #009FA8;
        display: flex;
        align-items: center;
        padding: 10px 20px;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 70px;
        z-index: 10;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    }

    h1{
        font-family:Arial, Helvetica, sans-serif;
        color:white;
        position:absolute;
        margin-left:45%;
    }

    .alicasa {
        background-image: url("{{ asset('img/alicasa_1.png') }}");
        background-size:100%;
        background-position: center;
        position: absolute;
        left: 10.5%;
        top:10px;
        transform: translateX(-50%);
        width: 70px;
        height: 70px;
        border:hidden;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    .alicasa:hover{
        background-image: url("{{ asset('img/alicasa_2.png') }}");
        background-size:100%;
        background-position: center;
    }
    
    .perfil{
        padding: 8px 20px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-left: 15px;
    }

    .sin_registrar, .registrado {
        display: flex;
        gap: 30px;
        margin-left: 79%;
        text-align: center;
    }

    .menu{
        margin-left: 15px;
        width: 40px;
        font-size: 25px;
        font-weight: bold;
        border: 2px solid #009FA8;
        border-radius: 50px;
        background-color: white;
        color: #009FA8;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .menu:hover{
        background-color: #003f5c;
        color: white;
        border-color:white;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .barrita-menu{
        display: flex;
        position: fixed;
        top: 90px;
        z-index: 10;
        right: 0;
        background-color:#003f5c;
        width: 100%;
        height: 70px;
        align-items: center;
        justify-content: space-evenly;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    }

    .boton-menu{
        font-family: Arial, Helvetica, sans-serif;
        border: 2px solid white;
        border-radius: 50px;
        background-color: #009FA8;
        color: white;
        font-size: 17px;
        font-weight: bold;
        padding: 5px 15px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .boton-menu:hover{
        background-color: white;
        color: #009FA8;
        border-color:white;
    }

    .linea {
        width: 2px;
        height: 40px;
        background-color: #009FA8;
        border-radius: 50px;
    }

    .boton {
        padding: 8px 20px; 
        border: 2px solid #009FA8;
        background-color: white;
        color: #009FA8;
        cursor: pointer;
        border-radius: 25px;
        font-size: 18px;
        white-space: nowrap;
        transition: all 0.3s ease-in-out;
    }

    .boton:hover {
        background-color: #003f5c;
        color: white;
        border-color:white;
        transform: scale(1.05);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    a{
        text-decoration: none;
        text-align:center;
    }

    body {
        padding-top: 80px;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menu = document.getElementById("barrita-menu");
        const barra = document.getElementById("barra");
        const body = document.body;
        const estadoMenu = localStorage.getItem("estadoMenu");

        if (estadoMenu === "flex") {
            menu.style.display = "flex";
            barra.style.boxShadow = "none";
            body.style.paddingTop = "150px";
        } else {
            menu.style.display = "none";
            barra.style.boxShadow = "0 10px 30px rgba(0, 0, 0, 0.4)";
            body.style.paddingTop = "80px";
        }
    });

    function mostrarMenu() {
        const menu = document.getElementById("barrita-menu");
        const barra = document.getElementById("barra");
        const body = document.body;

        if (menu.style.display === "none") {
            menu.style.display = "flex";
            barra.style.boxShadow = "none";
            body.style.paddingTop = "150px";
            localStorage.setItem("estadoMenu", "flex");
        } else {
            menu.style.display = "none";
            barra.style.boxShadow = "0 10px 30px rgba(0, 0, 0, 0.4)";
            body.style.paddingTop = "80px";
            localStorage.setItem("estadoMenu", "none");
        }
    }
</script>
