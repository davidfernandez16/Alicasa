<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inmueble;
use App\Models\User;
use App\Models\Ciudad;

class InmuebleController extends Controller
{
    public function borrar($id){
        $inmueble = Inmueble::findOrFail($id);
        $usuario = User::findOrFail($inmueble->propietario);
        if($inmueble){
            $inmueble->delete();
            $esPropietario = Inmueble::where('propietario', $usuario->id)->exists();
            if($esPropietario == False){
                $usuario->propietario = 0;
            }
            if($esPropietario == True){
                $usuario->propietario = 1;
            }
                $usuario->save();
            return redirect()->action([InmuebleController::class, 'ver_inmuebles']);
        }
    }
    public function modificar_inmueble($id){
        $inmueble = Inmueble::findOrFail($id);
        $ciudades = Ciudad::all();
        $propietarios = User::all();
        return view("modificar.inmueble",compact('inmueble', 'ciudades', 'propietarios'));
    }
    public function modificar(Request $request,$id){        
        $inmueble = Inmueble::findorFail($id);
        if (!empty(request('direccion'))) {
            $direccion = $request->input('direccion');
            $request->validate(['direccion' => 'required|string|max:255']);
            $inmueble->direccion = $direccion;
        }
        if (!empty(request('num_habitaciones'))) {
            $num_habitaciones = $request->input('num_habitaciones');
            $request->validate(['num_habitaciones' => 'required|integer|min:1|max:50']);
            $inmueble->num_habitaciones = $num_habitaciones;
        }
        if (!empty(request('superficie'))) {
            $superficie = $request->input('superficie');
            $request->validate(['superficie' => 'required|numeric|min:10|max:1000']);
            $inmueble->superficie = $superficie;
        }
        if (!empty(request('categoria'))) {
            $categoria = $request->input('categoria');
            $request->validate(['categoria' => 'required|in:Piso,Casa,Apartamento,Estudio,Chalet,Duplex,Villa,Casa_rural,Loft,Adosado']);
            $inmueble->categoria = $categoria;
        }
        if (!empty(request('precio'))) {
            $precio = $request->input('precio');
            $request->validate(['precio' => 'required|numeric|min:1|max:10000']);
            $inmueble->precio = $precio;
        }
        if (!empty(request('imagen'))) {
            $imagen = $request->input('imagen');
            $request->validate(['imagen' => 'image|mimes:png,jpg|max:2048']);
            if (is_uploaded_file($_FILES['imagen']['tmp_name']))
            {
                if(empty($_FILES['imagen']['name']))
                {
                    return redirect()->route('ver.inmueble')->withErrors(['Archivo no encontrado']);
                }

                $imagen = $_FILES['imagen']['name'];
                if(strlen ($imagen)>100)
                {
                    return redirect()->route('ver.inmueble')->withErrors(['Nombre del archivo demasiado largo']);
                }
                $imagen = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $imagen);
                if ($_FILES['imagen']['size'] > 1000000)
                {
                    return redirect()->route('ver.inmueble')->withErrors(['Imagen demasiado grande']);
                }
                $dest=dirname(__DIR__, 3).'/public/';
                if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $dest.'img/inmuebles/inmueble_'.$id.'.png'))
                {
                    return redirect()->route('ver.inmueble')->withErrors(['Error al subir la imagen']);
                }
                if($inmueble->imagen == "img/inmueble.png"){
                    $inmueble->imagen = 'img/inmuebles/inmueble_'.$id.'.png';
                }
            }
        }
        if (!empty(request('descripcion'))) {
            $descripcion = $request->input('descripcion');
            $request->validate(['descripcion' => 'nullable|string|max:1000']);
            $inmueble->descripcion = $descripcion;
        }
        if ($request->input('wifi') != "")  {
            $wifi = $request->input('wifi');
            $request->validate(['wifi' => 'required|boolean']);
            $inmueble->wifi = $wifi;
        }
        if ($request->input('piscina') != "")  {
            $piscina = $request->input('piscina');
            $request->validate(['piscina' => 'required|boolean']);
            $inmueble->piscina = $piscina;
        }
        if (!empty(request('ciudad'))) {
            $ciudad = $request->input('ciudad');
            $request->validate(['ciudad' => 'required|exists:ciudad,id']);
            $inmueble->ciudad = $ciudad;
        }
        if ($request->input('propietario') != "")  {
            $propietario = $request->input('propietario');
            $request->validate(['propietario' => 'required|exists:usuario,id']);
            $inmueble->propietario = $propietario;
        }
        $inmueble->save();
        return redirect()->action([InmuebleController::class, 'ver_inmuebles']);
    }
    public function ver_inmuebles(){
        $inmuebles = Inmueble::paginate(15);
        $relacion = 0;
        $direccion = "asc"; 
        return view('administracion.ver_inmuebles',compact('inmuebles','direccion','relacion'));
    }
    public function insertar_inmueble(){
        $ciudades = Ciudad::all();
        $propietarios = User::all();
        return view("insertar.inmueble", compact('ciudades','propietarios'));
    }
    public function insertar(Request $request){
        $request->validate([
            'direccion'         => 'required|string|max:255',
            'num_habitaciones'  => 'required|integer|min:1|max:50',
            'superficie'        => 'required|numeric|min:10|max:1000',
            'categoria'         => 'required|in:Piso,Casa,Apartamento,Estudio,Chalet,Duplex,Villa,Casa_rural,Loft,Adosado',
            'precio'            => 'required|numeric|min:1|max:10000',
            'imagen'            => 'image|mimes:png|max:2048',
            'descripcion'       => 'nullable|string|max:1000',
            'wifi'              => 'required|boolean',
            'piscina'           => 'required|boolean',
            'ciudad'            => 'required|exists:ciudad,id',
            'propietario'       => 'required|exists:usuario,id',
        ]);

        $direccion = $request->input('direccion');
        $num_habitaciones = $request->input('num_habitaciones');
        $superficie = $request->input('superficie');
        $categoria = $request->input('categoria');
        $precio = $request->input('precio');
        $imagen = $request->input('imagen');
        $descripcion = $request->input('descripcion');
        $wifi = $request->input('wifi');
        $piscina = $request->input('piscina');
        $ciudad = $request->input('ciudad');
        $propietario = $request->input('propietario');
        
        $inmueble = new Inmueble();
        $id = Inmueble::all()->count() + 1;
        $inmueble->direccion = $direccion;
        $inmueble->num_habitaciones = $num_habitaciones;
        $inmueble->superficie = $superficie;
        $inmueble->categoria = $categoria;
        $inmueble->precio = $precio;
        $inmueble->descripcion = $descripcion;
        $inmueble->wifi = $wifi;
        $inmueble->piscina = $piscina;
        $inmueble->ciudad = $ciudad;
        $inmueble->propietario = $propietario;

        if($request->hasFile('imagen')){
            if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
                if(empty($_FILES['imagen']['name']))
                {
                    return redirect()->route('ver.inmueble')->withErrors(['Archivo no encontrado']);
                }
                $imagen = $_FILES['imagen']['name'];
                if(strlen ($imagen)>100)
                {
                    return redirect()->route('ver.inmueble')->withErrors(['Nombre del archivo demasiado largo']);

                }
                $imagen = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $imagen);
                if ($_FILES['imagen']['size'] > 1000000)
                {
                    return redirect()->route('ver.inmueble')->withErrors(['Imagen demasiado grande']);
                }
                $dest=dirname(__DIR__, 3).'/public/';
                if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $dest.'img/inmuebles/inmueble_'.$id.'.png'))
                {
                    return redirect()->route('ver.inmueble')->withErrors(['Error al subir la imagen']);
                }
                $inmueble->imagen = 'img/inmuebles/inmueble_'.$id.'.png';
            }
        }
        $usuario = User::FindOrFail($inmueble->propietario);
        $usuario->propietario = 1;
        $inmueble->save();
        $usuario->save();
        session()->flash('success', 'inmueble creado con éxito');
        return redirect()->action([InmuebleController::class, 'ver_inmuebles']);
    }
    public function ordenar(Request $request, $direccion){
        if(request('columna')) {
            session(['columna' => request('columna')]);
        }

        $boton = session('columna', 'id');
        $direccion = $direccion === "asc" ? "desc" : "asc";

        if($boton == 'ciudad') {
            $inmuebles = Inmueble::join('ciudad', 'inmueble.ciudad', '=', 'ciudad.id')
                ->orderBy('ciudad.localidad', $direccion)
                ->select('inmueble.*')
                ->paginate(15)
                ->appends([
                    'columna' => $boton,
                    'direccion' => $direccion
                ]);
        }
        elseif($boton == 'propietario') {
            $inmuebles = Inmueble::join('usuario', 'inmueble.propietario', '=', 'usuario.id')
                ->orderBy('usuario.nombre', $direccion)
                ->select('inmueble.*')
                ->paginate(15)
                ->appends([
                    'columna' => $boton,
                    'direccion' => $direccion
                ]);
        }
        else{
            $inmuebles = Inmueble::orderBy($boton, $direccion)
                ->paginate(15)
                ->appends([
                    'columna' => $boton,
                    'direccion' => $direccion
                ]);
        }

        $relacion = 0;
        return view('administracion.ver_inmuebles', compact('inmuebles', 'direccion', 'relacion'));
    }
    //Relacion para ver al propietario del inmueble
    public function ver_usuario($id){
        $usuarios = User::where('id', $id)->paginate(15);
        $direccion = "asc";
        $nombre = User::findOrFail($id)->nombre;
        $relacion = 1;
        return view('administracion.ver_usuarios',compact('usuarios','direccion','nombre','relacion'));
    }
    //Relacion para ver los datos de esa ciudad
    public function ver_ciudad($id){
        $ciudades = Ciudad::where('id', $id)->paginate(15);
        $direccion = "asc";
        $nombre = Ciudad::findOrFail($id)->localidad;
        $relacion = 1;
        return view('administracion.ver_ciudades',compact('ciudades','direccion','nombre','relacion'));
    }
}
