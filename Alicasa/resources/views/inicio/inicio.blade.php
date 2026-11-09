@extends('layouts.app')

@section('title', 'Inicio')
<div class="carrusel">
    <div class="imagenes" id="imagenes">
        <img src="{{ asset('img/inicio/fondo_4.png') }}">
        <img src="{{ asset('img/inicio/fondo_1.png') }}">
        <img src="{{ asset('img/inicio/fondo_2.png') }}">
        <img src="{{ asset('img/inicio/fondo_3.png') }}">
        <img src="{{ asset('img/inicio/fondo_4.png') }}">
        <img src="{{ asset('img/inicio/fondo_1.png') }}">
    </div>
    
    <button id="anterior">&#10094;</button>
    <button id="siguiente">&#10095;</button>

    <div class="indicadores">
        <span class="indicador" data-index="1"></span>
        <span class="indicador" data-index="2"></span>
        <span class="indicador" data-index="3"></span>
        <span class="indicador" data-index="4"></span>

    </div>
</div>

@section('content')
    <style>
        html, body {
            margin: 0;
            width: 100%;
        }
        .container {
            font-family: "arial";
            margin: 80px auto 20px;
            margin-bottom: 0px;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .carrusel {
            width: 100%;
            overflow: hidden;
            position: relative;
        }
        .imagenes {
            display: flex;
            transition: transform 0.5s ease;
            width: max-content;
            transform: translateX(-100vw);
        }
        .imagenes img {
            width: 100vw;
            height: 770px;
            object-fit: cover;
        }
        #anterior, #siguiente {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #009FA8;
            color: white;
            border: 2px solid white;
            font-size: 20px;
            padding: 10px 20px;
            cursor: pointer;
            z-index: 1;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
        }
        #anterior {
            left: 20px;
        }
        #siguiente {
            right: 20px;
        }
        #anterior:hover, #siguiente:hover {
            background-color: #003f5c;
            color: white;
            border-color: white;
        }
        #anterior:active, #siguiente:active {
            transition: 0s ease-in-out;

            border-color: #009FA8;
            color: #009FA8;
        }
        .indicadores {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }
        .indicador {
            width: 10px;
            height: 10px;
            background-color: #bbb;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .indicador.active {
            background-color: #009FA8;
        }
        .titulo{
            color:#003f5c;
            text-align: center;
            font-size: 35px;
            font-weight: bold;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .elegir{
            width: 80%;
            height: auto;
            min-height: 100px;
            max-width: 80%;
            padding: 20px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap:125px;
        }
        .facil{
            width:250px;
            height: 250px;
            border: none;
            background-image: url("{{ asset('img/inicio/frs/facil_1.png') }}");
            background-size:100%;
            background-position: center;
            transition: all 0.2s ease-in-out;
        }
        .facil:hover{
            background-image: url("{{ asset('img/inicio/frs/facil_2.png') }}");
        }
        .rapido{
            width:250px;
            height: 250px;
            border: none;
            background-image: url("{{ asset('img/inicio/frs/rapido_1.png') }}");
            background-size:100%;
            background-position: center;
            transition: all 0.2s ease-in-out;
        }
        .rapido:hover{
            background-image: url("{{ asset('img/inicio/frs/rapido_2.png') }}");
        }
        .seguro{
            width:250px;
            height: 250px;
            border: none;
            background-image: url("{{ asset('img/inicio/frs/seguro_1.png') }}");
            background-size:100%;
            background-position: center;
            transition: all 0.2s ease-in-out;
        }
        .seguro:hover{
            background-image: url("{{ asset('img/inicio/frs/seguro_2.png') }}");
        }
        .frs{
            width: 60%;
            min-height: 100px;
            margin-top: 50px;
            padding: 20px;
            border:1px solid black;
            border-radius: 25px;
            text-align:center;            
        }
        .filtro{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            width: 60%;
            height: 80px;
            background-color: #009FA8;
            border-radius: 50px;
        }
        .filtro select{
            appearance: none;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 40%;
            height: 100%;
            background: none;
            border:none;
            border-radius: 50px;
            color: white;
            text-align: center;
            font-size: 20px;
            transition: all 0.3s ease-in-out;
        }
        .filtro select:hover{
            border:10px solid #003f5c;
        }
        .filtro select:active{
            background-color: #003f5c;
        }
        .filtro select option{
            color:black;
            background-color: white;
            width: 10px;
            font-size: 15px;
        }
        .filtro button{
            width: 40px;
            height: 40px;
            background-image: url("{{ asset('img/inicio/lupa_1.png') }}");
            background-size:100%;
            background-position: center;
            border: 2px solid white;
            border-radius: 50%;
            cursor:pointer;
            transition: all 0.3s ease-in-out;
        }
        .filtro button:hover{
            background-image: url("{{ asset('img/inicio/lupa_2.png') }}");

        }
        .valorados {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            width: 60%;
            padding: 20px;
            text-align: center;
        }
        .inmueble {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 20px;
            gap: 10px;
            border: none;
            border-radius: 25px;
            background: none;
            color: black;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }
        .inmueble img{
            border:5px solid #003f5c;
            border-radius: 25px;
            width: 250px;
            height: 250px;
            object-fit: cover;
        }
        .ciudad{
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .precio_valor{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            font-weight: normal;
            font-size: 15px;
            width: 100%;
            cursor: pointer;
        }
        .mas {
            padding: 10px 20px;
            font-size: 15px;
            background-color: #009FA8;
            border: 2px solid #009FA8;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            height: fit-content;
            color:white;
            margin-top: -35px ;
        }
        .mas:hover {
            background-color: #003f5c;
            color: white;
            border-color: white;
            transform: scale(1.1);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .abajo{
            display: flex;
            flex-direction: column;
            min-height: 100px;
            margin-top: 50px;
            width: 97%;
            text-align: left;
            justify-content: space-evenly;
            padding-top: 20px;
            padding-left: 3%;
            padding-bottom: 10px;
            gap:25px;
            font-size:25px;
            font-weight: bold;
            color: #009FA8;
            background-color:rgb(235, 235, 235);
        }
        .contacto{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
        }
        .informacion{
            display: flex;
            flex-direction: column;
            align-items:start;
            justify-content: space-around;
            font-size: 15px;
            font-weight: normal;
            color:black;
            gap:10px;
        }
        .derechos{
            text-align: center;
            font-size: 15px;
            font-weight: normal;
            color: black;
        }
    </style>
    
    <label class="titulo">Encuentra tu apartamento ideal</label>
    <form action="{{ route('inicio.buscar') }}" method="GET" class="filtro">
            <select name="ciudad">
                <option value="" hidden selected>¿Cuál es tu déstino?</option>
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}">{{ $ciudad->localidad }}</option>
                @endforeach
            </select>
            <select name="categoria">
                <option value="" hidden selected>¿Qué buscas?</option>
                <option value="Adosado">Adosado</option>
                <option value="Apartamento">Apartamento</option>
                <option value="Casa">Casa</option>
                <option value="Casa_rural">Casa Rural</option>
                <option value="Chalet">Chalet</option>
                <option value="Duplex">Dúplex</option>
                <option value="Estudio">Estudio</option>
                <option value="Loft">Loft</option>
                <option value="Piso">Piso</option>
                <option value="Villa">Villa</option>
            </select>
            <button></button>
    </form>

    <label for="filtros" class="titulo">Lo que nos diferencia</label>
    <div class="elegir">
        <button class="facil"></button>
        <button class="rapido"></button>
        <button class="seguro"></button>
    </div>
    
    <label class="titulo">Mejores Valorados</label>
    <div class="valorados">
    @foreach ($inmuebles as $index => $inmueble)
        <form action="{{ route('inicio.inmueble', $inmueble->id) }}" target="_blank" method="GET" class="tarjeta-inmueble" data-index="{{ $index }}">
            @php
                $nombre = App\Models\User::find($inmueble->propietario)->nombre;
                $ciudad = App\Models\Ciudad::find($inmueble->ciudad)->localidad;
                $provincia = App\Models\Ciudad::find($inmueble->ciudad)->provincia;
            @endphp
            <button class="inmueble">
                <img src="{{ asset($inmueble->imagen) }}">
                @if($inmueble->categoria == "Casa_rural")
                    <label class="ciudad">Casa Rural en {{$provincia}}</label>
                @else
                    <label class="ciudad">{{$inmueble->categoria}} en {{$ciudad}}</label>
                @endif
                <div class="precio_valor">
                    <label>{{$inmueble->precio}}€ Noche</label>
                    <label>★ {{ number_format($inmueble->resenyas_avg_valoracion_inmueble, 2, ',', '') }}</label>
                </div>
            </button>
        </form>
    @endforeach
    </div>
    
    <div style="width: 100%; text-align: center; margin-top: 30px;">
        <button id="mostrarMasBtn" class="mas">Mostrar más</button>
    </div>
    
    <div class="abajo">
        <div class="contacto">
            <div class="informacion">
                <label style="font-weight: bold;">Redes Sociales</label>
                <a href="https://www.instagram.com" target="_blank" style="text-decoration: none; color:black;">Instagram</a>
                <a href="https://www.facebook.com" target="_blank" style="text-decoration: none; color:black;">Facebook</a>
                <a href="https://www.twitter.com" target="_blank" style="text-decoration: none; color:black;">Twitter</a>
            </div>
            <div class="informacion">
                <label style="font-weight: bold;">Contacto</label>
                <label>965 33 33 33</label>
                <a href="mailto:dss.alicasa@gmail.com" target="_blank" style="text-decoration: none; color:black;">Dss.alicasa@gmail.com</a>
                <a href="{{ route('inicio.contacto') }}" style="text-decoration: none; color:black;">Contacta con nosotros</a>
            </div>
            <div class="informacion">
                <label style="font-weight: bold;">Ayuda</label>
                <label style="cursor:pointer;">Términos y condiciones</label>
                <label style="cursor:pointer;">Política de privacidad</label>
                <a href="{{ route('inicio.informacion') }}" style="text-decoration: none; color:black;">Quiénes somos</a>
            </div>
        </div>
        <div class="derechos">
            <label> © 2025 ALICASA. Todos los derechos reservados.</label>
        </div>

    </div>

    <script>
        const imagenes = document.getElementById("imagenes");
        const btnNext = document.getElementById("siguiente");
        const btnPrev = document.getElementById("anterior");
        const indicadores = document.querySelectorAll(".indicador");
        const mostrarMasBtn = document.getElementById("mostrarMasBtn");
        const tarjetas = document.querySelectorAll(".tarjeta-inmueble");

        let index = 1;
        let intervalo;

        function actualizarIndicadores() {
            indicadores.forEach(indicador => {
                indicador.classList.remove("active");
            });
            indicadores[index - 1].classList.add("active");
        }

        function mover() {
            imagenes.style.transition = "transform 0.5s ease";
            imagenes.style.transform = `translateX(-${index * 100}vw)`;
        }

        function siguienteImagen() {
            index++;
            mover();

            if (index === 5) {
                setTimeout(() => {
                    imagenes.style.transition = "none";
                    index = 1;
                    imagenes.style.transform = `translateX(-${index * 100}vw)`;
                    actualizarIndicadores();
                }, 500);
            } else {
                actualizarIndicadores();
            }
        }

        function anteriorImagen() {
            index--;
            mover();

            if (index === 0) {
                setTimeout(() => {
                    imagenes.style.transition = "none";
                    index = 4;
                    imagenes.style.transform = `translateX(-${index * 100}vw)`;
                    actualizarIndicadores();
                }, 500);
            } else {
                actualizarIndicadores();
            }
        }

        btnNext.addEventListener("click", () => {
            siguienteImagen();
            reiniciarIntervalo();
        });

        btnPrev.addEventListener("click", () => {
            anteriorImagen();
            reiniciarIntervalo();
        });

        function iniciarIntervalo() {
            intervalo = setInterval(siguienteImagen, 5000);
        }

        function reiniciarIntervalo() {
            clearInterval(intervalo);
            iniciarIntervalo();
        }

        window.onload = () => {
            actualizarIndicadores();
            iniciarIntervalo();
        };

        tarjetas.forEach((form, index) => {
            if (index >= 3) {
                form.style.display = "none";
            }
        });

        mostrarMasBtn.addEventListener("click", function () {
            tarjetas.forEach(form => {
                form.style.display = "block";
            });
            this.style.display = "none";
        });
    </script>

    
@endsection