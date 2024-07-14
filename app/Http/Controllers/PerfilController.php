<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller; // Asegúrate de importar la clase Controller


class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => [
                'unique:users,username,' . auth()->user()->id,
                'required',
                'min:3',
                'max:20'],
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');
 
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
     
            $manager = new ImageManager(new Driver());
     
            $imagenServidor = $manager::gd()->read($imagen);
            $imagenServidor->cover(1000,1000);
     
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
     
            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        // Redireccionar
       
        return redirect()->route('posts.index', $usuario->username);
    }

}