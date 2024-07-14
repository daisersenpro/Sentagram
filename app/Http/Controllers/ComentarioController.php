<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)

    {
        // validar
        $validatedData = $request->validate( [
            'comentario' => 'required|max:255'
        ]);


        // almacenar resultado
        Comentario::create([
          'user_id'=> auth()->user()->id, 
          'post_id'=> $post->id,
          'comentario'=> $request->comentario  
        ]);


        // imprimir un mensaje
        return back()->with('mensaje', 'Comentario Creado Correctamente');
    }
}
