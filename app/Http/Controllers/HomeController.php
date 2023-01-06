<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    //En vez de tener un solo emtodo en controller se utiliza un metodo INVOKE
    public function __invoke()
    {
        //Obtener a quienes seguimos pluck= nos va a trae unicamente ciertocs campos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);



        return view('home', [
            'posts' => $posts
        ]);
    }
}
