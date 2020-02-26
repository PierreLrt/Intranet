<?php

namespace App\Http\Controllers;

use App\Actualite;
use App\Commentaire;
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

        foreach ($actualites as $actualite) {
            $commentaires = Commentaire::join('users', 'users.id', '=', 'commentaires.user_id')->select('commentaires.created_at', 'commentaires.message', 'commentaires.id', 'users.name')->where('actualite_id', $actualite['id'])->orderBy('commentaires.created_at', 'DESC')->get();
            $actualite['commentaires'] = $commentaires;
        }

        return view('home', compact('actualites'));
    }
}
