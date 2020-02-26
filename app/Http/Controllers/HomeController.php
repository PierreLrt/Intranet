<?php

namespace App\Http\Controllers;

use App\Actualite;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $actualites = Actualite::join('users', 'users.id', '=', 'actualites.user_id')->select('actualites.created_at', 'actualites.titre', 'actualites.id', 'actualites.contenu', 'users.name')->orderBy('actualites.created_at', 'DESC')->get();

        return view('home', compact('actualites'));
    }
}
