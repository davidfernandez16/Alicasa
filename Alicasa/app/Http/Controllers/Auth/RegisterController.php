<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Dónde redirigir tras el registro.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validador de los datos del registro.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'         => ['required','email','max:50','unique:usuario,email'],
            'password'      => ['required','string','min:6','confirmed'],
            'nombre'        => ['required','regex:/^[a-zA-Z- áéíóúÁÉÍÓÚ]+$/u','min:3','max:50'],
            'apellidos'     => ['required','regex:/^[a-zA-Z- áéíóúÁÉÍÓÚ]+$/u','min:3','max:50'],
            'telefono'      => ['nullable','numeric','digits_between:9,15'],
            'imagen'        => ['nullable','image','mimes:png,jpg,jpeg','max:2048'],
            'propietario'   => ['sometimes','boolean'],
            'administrador' => ['sometimes','boolean'],
        ]);
    }

    /**
     * Crea el usuario tras validación.
     */
    protected function create(array $data)
    {
        // Crea el usuario sin la imagen aún
        $user = User::create([
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'nombre'        => $data['nombre'],
            'apellidos'     => $data['apellidos'],
            'telefono'      => $data['telefono'] ?? null,
            'propietario'   => $data['propietario'] ?? 0,
            'administrador' => $data['administrador'] ?? 0,
        ]);

        // Procesa la imagen si viene
        if (isset($data['imagen'])) {
            $file      = request()->file('imagen');
            $filename  = 'usuario_'.time().'.'.$file->extension();
            $file->storeAs('public/images/usuarios', $filename);
            $user->imagen = 'storage/images/usuarios/'.$filename;
            $user->save();
        }

        return $user;
    }
}
