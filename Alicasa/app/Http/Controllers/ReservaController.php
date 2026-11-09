<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Inmueble;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class ReservaController extends Controller
{
    public function borrar($id){
        $reserva = Reserva::findOrFail($id);
        if($reserva){
            $reserva->delete();
            return redirect()->action([ReservaController::class, 'ver_reservas']);
        }
    }
    public function modificar_reserva($id){
        $reserva = Reserva::findOrFail($id);
        $usuarios = User::all();
        $inmuebles = Inmueble::all();
        return view("modificar.reserva",compact('reserva','usuarios','inmuebles'));
    }
    public function modificar(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);    
        if (!empty($request->fecha_inicio)) {
            $request->validate(['fecha_inicio' => 'required|date|before_or_equal:fecha_fin',]);
            $reserva->fecha_inicio = $request->input('fecha_inicio');
        }    
        if (!empty($request->fecha_fin)) {
            $request->validate(['fecha_fin' => 'required|date|after_or_equal:fecha_inicio',]);
            $reserva->fecha_fin = $request->input('fecha_fin');
        } 
        if (!empty($request->estado)) {
            $reserva->estado = $request->input('estado');
        }   
        if (!empty($request->usuario)) {
            $reserva->usuario = $request->input('usuario');
        }
        
        if (!empty($request->inmueble)) {
            $reserva->inmueble = $request->input('inmueble');
        }
        $reserva->save();
        $reserva = Reserva::FindOrFail($id);
        $inmueble = Inmueble::FindOrFail($reserva->inmueble);
        $reserva->precio_total = $inmueble->precio * $reserva->dias;
        $reserva->save();
        return redirect()->action([ReservaController::class, 'ver_reservas']);
    }
    
    public function ver_reservas(){
        $reservas = Reserva::paginate(15)->appends(request()->only(['columna', 'direccion']));
        $direccion = "asc"; 
        return view('administracion.ver_reservas',compact('reservas','direccion'));
    }
    public function insertar_reserva(){
        $usuarios = User::all();
        $inmuebles = Inmueble::all();
        return view("insertar.reserva", compact('usuarios','inmuebles'));
    }
    public function insertar(Request $request)
    {
        $request->validate([
            'fecha_inicio'  => 'required|date|before_or_equal:fecha_fin',
            'fecha_fin'     => 'required|date|after_or_equal:fecha_inicio',
            'estado'        => 'required|in:Pendiente,Aceptada,Cancelada',
            'usuario'       => 'required|exists:usuario,id',
            'inmueble'      => 'required|exists:usuario,id',
        ]);
        
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        $estado = $request->input('estado');
        $usuario_id = $request->input('usuario');
        $inmueble_id = $request->input('inmueble');

        $reserva = new Reserva();
        $reserva->fecha_inicio = $fecha_inicio;
        $reserva->fecha_fin = $fecha_fin;
        $reserva->estado = $estado;
        $reserva->usuario = $usuario_id;
        $reserva->inmueble = $inmueble_id;
        $reserva->save();

        $id = Reserva::all()->count();
        $reserva = Reserva::findOrFail($id);
        $inmueble = Inmueble::findOrFail($inmueble_id);
        $precio_total = $inmueble->precio * $reserva->dias;
        $reserva->precio_total = $precio_total;
        $reserva->save();

        return redirect()->action([ReservaController::class, 'ver_reservas']);
    }
    public function ordenar(Request $request, $direccion){
        if (request('columna')) {
            session(['columna' => request('columna')]);
        }

        $boton = session('columna', 'id');
        $direccion = $direccion === "asc" ? "desc" : "asc";

        if ($boton == 'usuario') {
            $reservas = Reserva::join('usuario', 'reserva.usuario', '=', 'usuario.id')
                ->orderBy('usuario.nombre', $direccion)
                ->select('reserva.*')
                ->paginate(15)
                ->appends([
                    'columna' => $boton,
                    'direccion' => $direccion
                ]);
        }
        else {
            $reservas = Reserva::orderBy($boton, $direccion)
                ->paginate(15)
                ->appends([
                    'columna' => $boton,
                    'direccion' => $direccion
                ]);
        }

        $relacion = 0;
        return view('administracion.ver_reservas', compact('reservas', 'direccion'));
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

    public function reservar(Request $request, $id){
        $reservar = new Reserva();
        $reservar->usuario = Auth::user()->id;
        $reservar->inmueble = $id;
        $reservar->fecha_inicio = $request->fecha_inicio;
        $reservar->fecha_fin = $request->fecha_fin;
        $dias = (strtotime($reservar->fecha_fin) - strtotime($reservar->fecha_inicio)) / (60 * 60 * 24);
        $inmueble = Inmueble::findOrFail($reservar->inmueble);
        $reservar->precio_total = $inmueble->precio * $dias;
        $reservar->save();
        return redirect()->back();
    }
    public function cancelar($id){
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();
        return redirect()->back();
    }

    public function mis_reservas(){
        // Obtener todas las reseñas del usuario autenticado
        $reservas = Reserva::where('usuario', Auth::user()->id)->get();
        
        return view('perfil.mis_reservas', compact('reservas'));
    }
}
