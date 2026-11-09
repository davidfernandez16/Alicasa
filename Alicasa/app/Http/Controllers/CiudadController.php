<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudad;
use App\Models\Inmueble;

class CiudadController extends Controller
{
    public function borrar($id){
        $ciudad = Ciudad::findOrFail($id);
        if($ciudad){
            $ciudad->delete();
            return redirect()->action([CiudadController::class, 'ver_ciudades']);
        }
    }
    public function ver_ciudades(){
        $ciudades = Ciudad::paginate(15);
        $relacion = 0;
        $direccion = "asc";
        return view('administracion.ver_ciudades',compact('ciudades','direccion','relacion'));
    }

    public function insertar_ciudad(){
        
        return view("insertar.ciudad");
    }
    public function ordenar(Request $request, $direccion)
    {
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
        $ciudades = Ciudad::orderBy($boton, $direccion)->paginate(15)->appends([
            'columna' => $boton,
            'direccion' => $direccion
        ]);
        return view('administracion.ver_ciudades', compact('ciudades','direccion'));
    }

    public function insertar(Request $request)
    {
        $request->validate([
            'codigo_postal' => 'required|string|max:10',
            'localidad'     => 'required|string|max:100',
            'provincia'     => 'required|string|max:100',
            'pais'          => 'required|string|max:100',
        ]);
        
        $codigo_postal = $request->input('codigo_postal');
        $localidad = $request->input('localidad');
        $provincia = $request->input('provincia');
        $pais = $request->input('pais');

        $ciudad = new Ciudad();
        $ciudad->codigo_postal = $codigo_postal;
        $ciudad->localidad = $localidad;
        $ciudad->provincia = $provincia;
        $ciudad->pais = $pais;
        $ciudad->save();

        return redirect()->action([CiudadController::class, 'ver_ciudades']);
    }
    public function modificar_ciudad($id){
        $ciudad = \App\Models\Ciudad::findOrFail($id);
        return view('modificar.ciudad', compact('ciudad'));
    }
    public function modificar(Request $request, $id){
        $ciudad = \App\Models\Ciudad::findOrFail($id);

        if ($request->filled('codigo_postal')) {
            $request->validate([
                'codigo_postal' => 'string|max:10',
            ]);
            $ciudad->codigo_postal = $request->input('codigo_postal');
        }

        if ($request->filled('localidad')) {
            $request->validate([
                'localidad' => 'string|max:100',
            ]);
            $ciudad->localidad = $request->input('localidad');
        }

        if ($request->filled('provincia')) {
            $request->validate([
                'provincia' => 'string|max:100',
            ]);
            $ciudad->provincia = $request->input('provincia');
        }

        if ($request->filled('pais')) {
            $request->validate([
                'pais' => 'string|max:100',
            ]);
            $ciudad->pais = $request->input('pais');
        }

        $ciudad->save();

        return redirect()->action([CiudadController::class, 'ver_ciudades']);
    }
    public function ver_inmuebles($id){
        $inmuebles = Inmueble::where('ciudad', $id)->paginate(15);
        $relacion = 3;
        $localidad = Ciudad::findOrFail($id)->localidad;
        $direccion = "asc";
        return view('administracion.ver_inmuebles',compact('inmuebles','direccion','relacion','localidad'));
    }
}
