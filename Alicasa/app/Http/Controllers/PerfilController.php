<?php

namespace App\Http\Controllers;

use App\Models\Inmueble;
use App\Models\Ciudad;
use App\Models\User;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    /**
     * Muestra el perfil del usuario autenticado.
     */
    public function perfil()
    {
        // Obtiene al usuario que ha iniciado sesión
        $usuario = Auth::user();

        // Si por alguna razón no hay sesión activa,
        // redirige al login (opcional, ya lo gestiona el middleware)
        if (! $usuario) {
            return redirect()->route('login');
        }
        $inmuebles = Inmueble::where('propietario', $usuario->id)->count();
        return view('perfil.perfil', compact('usuario','inmuebles'));
    }
    public function editar_perfil(Request $request, $id){
        $user = User::findorFail($id);
        if (!empty(request('email'))) {
            $email = $request->input('email');
            $request->validate(['email' => 'min:6|max:50|unique:usuario,email|email']);
            $user->email = $email;
        }
        if (!empty(request('nombre'))) {
            $nombre = $request->input('nombre');
            $request->validate(['nombre' => 'regex:/^[a-zA-Z- áéíóúÁÉÍÓÚ]+$/u|min:3|max:50']);
            $user->nombre = $nombre;
        }
        if (!empty(request('apellidos'))) {
            $apellidos = $request->input('apellidos');
            $request->validate(['apellidos' => 'regex:/^[a-zA-Z- áéíóúÁÉÍÓÚ]+$/u|min:3|max:50']);
            $user->apellidos = $apellidos;
        }
        if (!empty(request('telefono'))) {
            $telefono = $request->input('telefono');
            $request->validate(['telefono' => 'numeric|digits_between:9,15']);
            $user->telefono = $telefono;
        }
        // Guardar los cambios en el usuario
        $user->save();

        // Redirigir a la vista de perfil con un mensaje de éxito
        return redirect()->action([PerfilController::class, 'perfil']);
    }
    public function mis_inmuebles($id){
        $usuario = User::findOrFail($id);
        $inmuebles = Inmueble::where('propietario', $usuario->id)->get();
        return view('perfil.mis_inmuebles', compact('usuario','inmuebles'));
    }
    public function subir_inmueble($id){
        $usuario = User::findOrFail($id);
        if ($usuario->administrador == 1) {
            return redirect()->action([PerfilController::class, 'perfil']);
        }
        $ciudades = Ciudad::all();
        $propietarios = User::all();
        return view('perfil.subir_inmueble', compact('usuario','ciudades','propietarios'));
    }
    public function ver_reservas($id){
        $id_usuario  = Auth::user()->id;
        $usuario = User::findOrFail($id_usuario);
        $todo = Reserva::where('inmueble', $id)->orderBy('fecha_inicio','asc')->get();
        $pendientes = Reserva::where('inmueble', $id)->where('estado','Pendiente')->orderBy('fecha_inicio','asc')->get();
        $aceptadas = Reserva::where('inmueble', $id)->where('estado','Aceptada')->orderBy('fecha_inicio','asc')->get();
        $canceladas = Reserva::where('inmueble', $id)->where('estado','Cancelada')->orderBy('fecha_inicio','asc')->get();
        $cantidad_pendientes = Reserva::where('inmueble', $id)->where('estado','Pendiente')->orderBy('fecha_inicio','asc')->count();
        $cantidad_aceptadas = Reserva::where('inmueble', $id)->where('estado','Aceptada')->orderBy('fecha_inicio','asc')->count();
        $cantidad_canceladas = Reserva::where('inmueble', $id)->where('estado','Cancelada')->orderBy('fecha_inicio','asc')->count();
        $inmueble = Inmueble::findOrFail($id);
        $direccion = $inmueble->direccion;
        if($usuario->propietario == true){
            return view('perfil.ver_reservas', compact('todo','pendientes','direccion','cantidad_pendientes','cantidad_aceptadas','cantidad_canceladas','aceptadas','canceladas'));
        }
        else{
            return redirect()->route('inicio.inmueble',$id);
        }
    }
    public function cancelar($id){
        $reserva = Reserva::findOrFail($id);
        $reserva->estado = "Cancelada";
        $reserva->save();
        return redirect()->back();
    }
    public function aceptar($id){
        $reserva = Reserva::findOrFail($id);
        $reserva->estado = "Aceptada";
        $reserva->save();
        return redirect()->back();
    }
    public function insertar_inmueble(Request $request, $id){
        $request->validate([
            'direccion'         => 'string|max:255',
            'habitaciones'      => 'integer|min:1|max:50',
            'superficie'        => 'numeric|min:10|max:100000',
            'categoria'         => 'in:Piso,Casa,Apartamento,Estudio,Chalet,Duplex,Villa,Casa_rural,Loft,Adosado',
            'precio'            => 'numeric|min:1|max:100000',
            'imagen'            => 'nullable|image|mimes:png,jpg|max:2048',
            'descripcion'       => 'string|max:1000',
            'wifi'              => 'boolean',
            'piscina'           => 'boolean',
            'ciudad'            => 'exists:ciudad,id',
        ]);
        $inmueble = new Inmueble();
        $inmueble->direccion = $request->input('direccion');
        $inmueble->num_habitaciones = $request->input('habitaciones');
        $inmueble->superficie = $request->input('superficie');
        $inmueble->categoria = $request->input('categoria');
        $inmueble->precio = $request->input('precio');
        $inmueble->descripcion = $request->input('descripcion');
        $inmueble->wifi = $request->input('wifi');
        $inmueble->piscina = $request->input('piscina');
        $inmueble->ciudad = $request->input('ciudad');
        $inmueble->propietario = $id;
        $id_inmueble = Inmueble::all()->count() + 1;
        $imagen = $request->input('imagen');
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
                if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $dest.'img/inmuebles/inmueble_'.$id_inmueble.'.png'))
                {
                    return redirect()->route('ver.inmueble')->withErrors(['Error al subir la imagen']);
                }
                $inmueble->imagen = 'img/inmuebles/inmueble_'.$id_inmueble.'.png';
            }
        }
        $inmueble->save();
        $usuario = User::findOrFail($id);
        $usuario->propietario = 1;
        $usuario->save();
        return redirect()->route('inicio.inmueble',$inmueble->id);
    }
}
