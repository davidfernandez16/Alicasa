<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resenya;
use App\Models\User;
use App\Models\Inmueble;
use Illuminate\Support\Facades\Auth;

class ResenyaController extends Controller
{
    public function borrar($id){
        $resenya = Resenya::findOrFail($id);
        if($resenya){
            $resenya->delete();
            return redirect()->action([ResenyaController::class, 'ver_resenyas']);
        }
    }
    public function ver_resenyas(){
        $resenyas = Resenya::paginate(15);
        $direccion = "asc";
        return view('administracion.ver_resenyas',compact('resenyas','direccion'));
    }
    public function ordenar(Request $request, $direccion){
        if (request('columna')) {
            session(['columna' => request('columna')]);
        }

        $boton = session('columna', 'id');
        $direccion = $direccion === "asc" ? "desc" : "asc";

        if ($boton == 'usuario') {
            $resenyas = Resenya::join('usuario', 'resenya.usuario', '=', 'usuario.id')
                ->orderBy('usuario.nombre', $direccion)
                ->select('resenya.*')
                ->paginate(15)
                ->appends([
                    'columna' => $boton,
                    'direccion' => $direccion
                ]);
        }
        else {
            $resenyas = Resenya::orderBy($boton, $direccion)
                ->paginate(15)
                ->appends([
                    'columna' => $boton,
                    'direccion' => $direccion
                ]);
        }

        $relacion = 0;
        return view('administracion.ver_resenyas', compact('resenyas', 'direccion'));
    }

    public function insertar_resenya(){
        $usuarios = \App\Models\User::all();
        $inmuebles = \App\Models\Inmueble::all();
        return view("insertar.resenya", compact('usuarios','inmuebles'));
    }
    
    public function insertar(Request $request){
        $request->validate([
            'valoracion_inmueble' => 'required|integer|min:1|max:5',
            'valoracion_propietario' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|max:1000',
            'usuario'    => 'required|exists:usuario,id',
            'inmueble'   => 'required|exists:inmueble,id',
        ]);

        $resenya = new Resenya();
        $resenya->valoracion_inmueble = $request->input('valoracion_inmueble');
        $resenya->valoracion_propietario = $request->input('valoracion_propietario');
        $resenya->comentario = $request->input('comentario');
        $resenya->usuario = $request->input('usuario');
        $resenya->inmueble = $request->input('inmueble');

        $resenya->save();

        return redirect()->action([ResenyaController::class, 'ver_resenyas']);
    }

    public function modificar_resenya($id){
        $resenya = Resenya::findOrFail($id);
        $inmuebles = \App\Models\Inmueble::all();
        $usuarios = \App\Models\User::all();
        return view("modificar.resenya",compact('inmuebles', 'resenya', 'usuarios'));
    }

    public function modificar(Request $request, $id){
        $resenya = Resenya::findOrFail($id);

        if (!empty($request->valoracion_inmueble)) {
            $request->validate([
                'valoracion_inmueble' => 'required|integer|min:1|max:5'
            ]);
            $resenya->valoracion_inmueble = $request->input('valoracion_inmueble');
        }

        if (!empty($request->valoracion_propietario)) {
            $request->validate([
                'valoracion_propietario' => 'required|integer|min:1|max:5'
            ]);
            $resenya->valoracion_propietario = $request->input('valoracion_propietario');
        }

        if (!empty($request->comentario)) {
            $request->validate([
                'comentario' => 'required|string|max:1000'
            ]);
            $resenya->comentario = $request->input('comentario');
        }

        if (!empty($request->usuario)) {
            $resenya->usuario = $request->input('usuario');
        }

        if (!empty($request->inmueble)) {
            $resenya->inmueble = $request->input('inmueble');
        }

        $resenya->save();

        return redirect()->action([ResenyaController::class, 'ver_resenyas']);
    }
    public function ver_usuario($id){
        $usuarios = User::where('id', $id)->paginate(15);
        $direccion = "asc";
        $nombre = User::findOrFail($id)->nombre;
        $relacion = 1;
        return view('administracion.ver_usuarios',compact('usuarios','direccion','nombre','relacion'));
    }
    public function ver_inmueble($id){
        $inmuebles = Inmueble::where('id', $id)->paginate(15);
        $direccion = "asc";
        $nombre = Inmueble::findOrFail($id)->id;
        $relacion = 1;
        return view('administracion.ver_inmuebles',compact('inmuebles','direccion','nombre','relacion'));
    }

    public function comentar(Request $request, $id){
        $request->validate([
            'comentario' => 'nullable|string|max:1000',
        ]);
        $resenya = new Resenya();
        $resenya->valoracion_inmueble = $request->input('valoracion_inmueble');
        $resenya->valoracion_propietario = $request->input('valoracion_propietario');
        if(!empty($request->input('comentario'))){
            $resenya->comentario = $request->input('comentario');
        }
        $resenya->usuario = Auth::user()->id;
        $resenya->inmueble = $id;
        $resenya->save();
        return redirect()->back();
    }
    public function cancelar($id){
        $resenya = Resenya::findOrFail($id);
        $resenya->delete();
        return redirect()->back();
    }
    
    public function mis_resenyas(){
        // Obtener todas las reseñas del usuario autenticado
        $resenyas = Resenya::where('usuario', Auth::user()->id)->get();
        
        return view('perfil.mis_resenyas', compact('resenyas'));
    }
}
