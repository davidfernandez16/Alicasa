<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ciudad;
use App\Models\Inmueble;
use App\Models\Resenya;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;


class AdministradorController extends Controller
{
    public function admin(){
        $usuarios = User::all();
        $ciudades = Ciudad::all();
        $inmuebles = Inmueble::all();
        $resenyas = Resenya::all();
        $reservas = Reserva::all();

        $usuario = Auth::user();

        if ($usuario->administrador) {

            return view('administracion.admin', compact('usuarios', 'inmuebles', 'reservas', 'resenyas', 'ciudades'));
        }
        else{
            return redirect()->action([InicioController::class, 'inicio']);
        }
    }
}
