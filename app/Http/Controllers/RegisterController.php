<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        // Si pasa la validación, puedes continuar con el siguiente paso, como guardar los datos.
        //Create user
        //dd('Creando Usuario');
        User::create([
           'name' => $request->name,
           'username' => Str::slug ($request->username),
           'email' => $request->email,
           'password' => Hash::make($request->password)
        ]);

        //Forma 1 para Autentiticar usuario
        //auth()->attempt([
            //'email' => $request->email,
            //'password' => $request->password
        //]);

        // Otra forma de autenticar 2
        auth()->attempt($request->only('email', 'password'));


        //Redireccionar
        return redirect()->route('posts.index');
    }
}
