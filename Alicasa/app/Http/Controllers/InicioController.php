<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inmueble;
use App\Models\Ciudad;
use App\Models\Reserva;
use App\Models\Resenya;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as Aut;


class InicioController extends Controller
{
    public function inicio(){
        $ciudades = Ciudad::orderBy('localidad')->get();
        $inmuebles = Inmueble::withAvg('resenyas', 'valoracion_inmueble')->orderByDesc('resenyas_avg_valoracion_inmueble')->take(18)->get();
        return view('inicio.inicio',compact('inmuebles','ciudades','inmuebles'));
    }
    public function contacto(){
        return view('inicio.contacto');
    }
    public function informacion(){
        return view('inicio.informacion');
    }
    public function buscar(Request $request){
        $inmueble = new Inmueble();
        if(!empty(request('ciudad'))) {
            $ciudad = $request->input('ciudad');
            $request->validate(['ciudad' => 'exists:ciudad,id']);
            $inmueble->ciudad = $ciudad;
        }
        if(!empty(request('categoria'))) {
            $categoria = $request->input('categoria');
            $request->validate(['categoria' => 'in:Piso,Casa,Apartamento,Estudio,Chalet,Duplex,Villa,Casa_rural,Loft,Adosado']);
            $inmueble->categoria = $categoria;
        }
        $query = Inmueble::query();
        foreach($inmueble->getAttributes() as $key => $value){
            if($value){
                $query->where($key, $value);
            }
        }
        $inmuebles = $query->get();
        $ciudades = Ciudad::orderBy('localidad')->get();
        return view('inicio.listado',compact('inmuebles','ciudades'));
    }
    public function filtrar(Request $request){
        $inmueble = new Inmueble();
        if (!empty(request('direccion'))) {
            $direccion = $request->input('direccion');
            $request->validate(['direccion' => 'string|max:255']);
            $inmueble->direccion = $direccion;
        }
        if(!empty(request('ciudad'))) {
            $ciudad = $request->input('ciudad');
            $request->validate(['ciudad' => 'exists:ciudad,id']);
            $inmueble->ciudad = $ciudad;
        }
        if(!empty(request('categoria'))) {
            $categoria = $request->input('categoria');
            $request->validate(['categoria' => 'in:Piso,Casa,Apartamento,Estudio,Chalet,Duplex,Villa,Casa_rural,Loft,Adosado']);
            $inmueble->categoria = $categoria;
        }
        if(!empty(request('min'))) {
            $min = $request->input('min');
            $request->validate(['min' => 'numeric|min:1|max:10000']);
            $inmueble->min = $min;
        }
        if(!empty(request('max'))) {
            $max = $request->input('max');
            $request->validate(['max' => 'numeric|min:1|max:10000']);
            $inmueble->max = $max;
        }
        if(!empty(request('num_habitaciones'))) {
            $num_habitaciones = $request->input('num_habitaciones');
            $request->validate(['num_habitaciones' => 'integer|min:1|max:50']);
            $inmueble->num_habitaciones = $num_habitaciones;
        }
        $query = Inmueble::query();
        foreach($inmueble->getAttributes() as $key => $value){
            if($value && $key !== 'min' && $key !== 'max'){
                $query->where($key, $value);
            }
        }
        if($inmueble->min){
            $query->where('precio', '>=', $inmueble->min);
        }
        if($inmueble->max){
            $query->where('precio', '<=', $inmueble->max);
        }        
        $inmuebles = $query->get();
        $ciudades = Ciudad::orderBy('localidad')->get();
        return view('inicio.listado',compact('inmuebles','ciudades'));
    }
    public function ver_inmueble($id){
        $inmueble = Inmueble::findOrFail($id);
        $cantidad_resenyas = Resenya::where('inmueble',$id)->count();
        $cantidad_reservas = Reserva::where('inmueble',$id)->count();
        $resenyas = Resenya::where('inmueble',$id)->get();
        $reservas = $inmueble->reservas()->get(['fecha_inicio', 'fecha_fin']);
        $fechas = [];
        foreach ($reservas as $reserva){
            $inicio = Carbon::parse($reserva->fecha_inicio);
            $fin = Carbon::parse($reserva->fecha_fin);
            while ($inicio->lte($fin)) {
                $fechas[] = $inicio->format('Y-m-d');
                $inicio->addDay();
            }
        }
        if(Aut::check()){
            $user = Aut::user()->id;
            $mi_reserva = Reserva::where('inmueble',$id)->where('usuario',$user)->first();
            $mi_resenya = Resenya::where('inmueble',$id)->where('usuario',$user)->first();
        }
        else{
            $user = null;
            $mi_reserva = null;
            $mi_resenya = null;
        }
        if($inmueble->propietario == $user){
            $esMio = true;
        }
        else{
            $esMio = false;
        }
        return view('producto.inmueble', compact('inmueble','fechas','resenyas','cantidad_resenyas','cantidad_reservas','mi_reserva','mi_resenya','user','esMio'));
    }
}
