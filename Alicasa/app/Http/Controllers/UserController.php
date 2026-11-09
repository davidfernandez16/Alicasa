<?php

namespace App\Http\Controllers;

use App\Models\Inmueble;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function borrar($id){
        $user = User::findOrFail($id);
        if($user){
            $user->delete();
            return redirect()->action([UserController::class, 'ver_usuarios']);
        }
    }
    public function modificar_user($id){
        $user = User::findorFail($id);
        return view("modificar.user",compact('user'));
    }
    public function modificar(Request $request,$id){
        $user = User::findorFail($id);
        if (!empty(request('email'))) {
            $email = $request->input('email');
            $request->validate(['email' => 'min:6|max:50|nullable|unique:usuario,email|email']);
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
            $request->validate(['telefono' => 'nullable|numeric|digits_between:9,15']);
            $user->telefono = $telefono;
        }
        if (!empty(request('imagen'))) {
            $imagen = $request->input('imagen');
            $request->validate(['imagen' => 'image|mimes:png,jpg|max:2048']);
            if (is_uploaded_file($_FILES['imagen']['tmp_name']))
            {
                if(empty($_FILES['imagen']['name']))
                {
                    return redirect()->route('ver.user')->withErrors(['Archivo no encontrado']);
                }

                $imagen = $_FILES['imagen']['name'];
                if(strlen ($imagen)>100)
                {
                    return redirect()->route('ver.user')->withErrors(['Nombre del archivo demasiado largo']);
                }
                $imagen = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $imagen);
                if ($_FILES['imagen']['size'] > 1000000)
                {
                    return redirect()->route('ver.user')->withErrors(['Imagen demasiado grande']);
                }
                $dest=dirname(__DIR__, 3).'/public/';
                if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $dest.'img/usuarios/usuario_'.$id.'.png'))
                {
                    return redirect()->route('ver.user')->withErrors(['Error al subir la imagen']);
                }
                if($user->imagen == "img/perfil.png"){
                    $user->imagen = 'img/usuarios/usuario_'.$id.'.png';
                }
            }
        }
        if ($request->input('propietario') != "")  {
            $propietario = $request->input('propietario');
            $request->validate(['propietario' => 'nullable|boolean']);
            $user->propietario = $propietario;
        }
        if ($request->input('administrador') != "") {
            $administrador = $request->input('administrador');
            $request->validate(['administrador' => 'nullable|boolean']);
            $user->administrador = $administrador;
        }
        $user->save();
        return redirect()->action([UserController::class, 'ver_usuarios']);
    }
    public function ver_usuarios(){
        $usuarios = User::paginate(15);
        $relacion = 0;
        $direccion = "asc";
        return view('administracion.ver_usuarios',compact('usuarios','direccion','relacion'));
    }
    public function insertar_user(){
        return view('insertar.user');
    }
    public function insertar(Request $request){
        $request->validate([
            'email' => 'required|unique:usuario,email|email|min:6|max:50',
            'password' => 'required|min:6',
            'nombre' => 'required|regex:/^[a-zA-Z- áéíóúÁÉÍÓÚ]+$/u|min:3|max:50',
            'apellidos' => 'required|regex:/^[a-zA-Z- áéíóúÁÉÍÓÚ]+$/u|min:3|max:50',
            'telefono' => 'required|numeric|digits_between:9,15',
            'propietario' => 'required|boolean',
            'administrador' => 'required|boolean',
            'imagen' => 'nullable|image|mimes:png,jpg|max:2048',
        ]);

        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $nombre = $request->input('nombre');
        $apellidos = $request->input('apellidos');
        $telefono = $request->input('telefono');
        $propietario = $request->input('propietario');
        $administrador = $request->input('administrador');

        $user = new User();
        $id = User::all()->count() + 1;
        $user->email = $email;
        $user->password = $password;
        $user->nombre = $nombre;
        $user->apellidos = $apellidos;
        $user->telefono = $telefono;
        $user->propietario = $propietario;
        $user->administrador = $administrador;

        if ($request->hasFile('imagen')){
            if (is_uploaded_file($_FILES['imagen']['tmp_name'])){
                if(empty($_FILES['imagen']['name']))
                {
                    return redirect()->route('ver.user')->withErrors(['Archivo no encontrado']);
                }
                $imagen = $_FILES['imagen']['name'];
                if(strlen ($imagen)>100)
                {
                    return redirect()->route('ver.user')->withErrors(['Nombre del archivo demasiado largo']);

                }
                $imagen = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $imagen);
                if ($_FILES['imagen']['size'] > 1000000)
                {
                    return redirect()->route('ver.user')->withErrors(['Imagen demasiado grande']);
                }
                $dest=dirname(__DIR__, 3).'/public/';
                if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $dest.'img/usuarios/usuario_'.$id.'.png'))
                {
                    return redirect()->route('ver.user')->withErrors(['Error al subir la imagen']);
                }
                $user->imagen = 'img/usuarios/usuario_'.$id.'.png';
            }
        }
        $user->save();
        return redirect()->action([UserController::class, 'ver_usuarios']);

    }
    public function ordenar(Request $request, $direccion){
        if (request('columna')) {
            session(['columna' => request('columna')]);
        }
        
        $boton = session('columna', 'id');
        if($direccion == "asc"){
            $direccion = "desc";
        }
        else{
            $direccion = "asc";
        }
        $usuarios = User::orderBy($boton, $direccion)->paginate(15)->appends([
            'columna' => $boton,
            'direccion' => $direccion
        ]);
        $relacion = 0;
        return view('administracion.ver_usuarios', compact('usuarios','direccion','relacion'));
    }
    //Relación para ver inmuebles del usuario
    public function ver_inmuebles($id){
        $inmuebles = Inmueble::where('propietario', $id)->paginate(15);
        $relacion = 2;
        $nombre = User::findOrFail($id)->nombre;
        $apellidos = User::findOrFail($id)->apellidos;
        $direccion = "asc";
        return view('administracion.ver_inmuebles',compact('inmuebles','direccion','relacion','nombre','apellidos'));
    }
}
