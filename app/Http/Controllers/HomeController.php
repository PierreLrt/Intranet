<?php

namespace App\Http\Controllers;

use App\Actualite;
use App\Commentaire;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $actualites = Actualite::join('users', 'users.id', '=', 'actualites.user_id')->select('actualites.created_at', 'actualites.titre', 'actualites.id', 'actualites.contenu', 'users.name', 'users.id AS idUser')->orderBy('actualites.created_at', 'DESC')->get();

        $userId = Auth::id();
        $currentUsers = User::join('role_user', 'users.id', '=', 'role_user.user_id')->join('roles', 'roles.id', '=', 'role_user.role_id')->select('roles.name')->where('users.id', $userId)->get();

        foreach ($actualites as $actualite) {
            $commentaires = Commentaire::join('users', 'users.id', '=', 'commentaires.user_id')->select('commentaires.created_at', 'commentaires.message', 'commentaires.id', 'users.name', 'users.id AS idUser')->where('actualite_id', $actualite['id'])->orderBy('commentaires.created_at', 'DESC')->get();
            $actualite['commentaires'] = $commentaires;
        }

        return view('home', compact('actualites', 'currentUsers'));
    }
}
