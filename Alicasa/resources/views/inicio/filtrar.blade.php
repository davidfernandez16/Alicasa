<style>
    .filtrar{
        display:flex;
        flex-direction: row;
        width: 80%;
        align-items: center;
        justify-content: center;
        padding: 15px;
        gap:15px;
    }
    .filtrar-detalles{
        display: flex;
        flex-direction: column;
        width: 20%;
        align-items: center;
    }
    .filtrar-detalles label{
        font-size: 14px;
        font-weight: 600;
    }
    .filtrar-detalles select{
        width: 100%;
        padding: 5px;
        border: 2px solid #ccc;
        border-radius: 7px;
        background-color: #EEEEEE;
        text-align: center;
        font-size: 14px;
        cursor: pointer;
    }
    .precio{
        display: flex;
        flex-direction: row;
        width: 100%;
        align-items: center;
        justify-content: space-between;
    }
    .precio input{
        width: 50%;
        padding: 5px;
        border: 2px solid #ccc;
        border-radius: 7px;
        background-color: white;
        font-size: 14px;
        text-align: center;
    }
    .filtrar-detalles-boton{
        display: flex;
        flex-direction: column;
        width: 8%;
        align-items: center;
    }
    .filtrar-detalles-boton button{
        width: 90%;
        border: 2px solid #003f5c;
        border-radius: 7px;
        background-color: #003f5c;
        color: white;
        font-weight: bold;
        padding: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }
    .filtrar-detalles-boton button:hover{
        background-color: white;
        color: #003f5c;
        border: 2px solid #003f5c;
    }
</style>
<form action="{{ route('inicio.filtrar') }}" method="POST" class="filtrar">
    @csrf
    <div class="filtrar-detalles">
        <label>CIUDAD</label>
        <select name="ciudad">
            <option value="" selected>Selecciona ciudad</option>
            @foreach ($ciudades as $ciudad)
                <option value="{{ $ciudad->id }}">{{ $ciudad->localidad }}</option>
            @endforeach
        </select>
    </div>
    <div class="filtrar-detalles">
        <label>CATEGORIA</label>
        <select name="categoria">
            <option value="" selected>Selecciona categoría</option>
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
    </div>
    <div class="filtrar-detalles">
        <label>PRECIO</label>
        <div class="precio">
            <input type="text" name="min" id="min" placeholder="MIN">
            <input type="text" name="max" id="max" placeholder="MAX">
        </div>
    </div>
    <div class="filtrar-detalles">
        <label for="num_habitaciones">Nº HABITACIONES</label>
        <select name="num_habitaciones">
            <option value="" selected>Selecciona habitaciones</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10 o más</option>
        </select>
    </div>
    <div class="filtrar-detalles-boton">
        <label for="filtrar" style="visibility: hidden;">Filtrar</label>
        <button>Filtrar</button>
    </div>
</form>