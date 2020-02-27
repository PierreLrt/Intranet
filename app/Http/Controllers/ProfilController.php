<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Publication;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index() {
        $userId = Auth::id();

        $user = User::select('name', 'email', 'created_at')->where('users.id', $userId)->first();

        return view('profil.index', compact('user'));
    }

    public function email() {
        $userId = Auth::id();

        $user = User::select('email')->where('users.id', $userId)->first();

        return view('profil.email', compact('user'));
    }

    public function changeEmail(Request $request) {
        $userId = Auth::id();

        $user = User::where('users.id', $userId)->first();

        $erreurs = [];

        if($user['email'] != $request['email']) {
            array_push($erreurs, "L'ancien email ne pas correct");
        }

        if($request['newemail'] != $request['confirmmail']) {
            array_push($erreurs, "Les emails ne sont pas identiques !");
        }

        if(empty($erreurs)) {
            $user['email'] = $request['newemail'];
            $user->save();

            session()->flash('succes', 'L\'email a été modifié !');
        }

        else {
            foreach ($erreurs as $erreur) {
                session()->flash('erreur', $erreur);
            }
        }

        return redirect()->route('profilEmail');
    }

    public function mdp() {
        return view('profil.mdp');
    }

    public function changeMdp(Request $request)
    {
        $userId = Auth::id();

        $user = User::where('users.id', $userId)->first();

        $erreurs = [];

        if(!password_verify($request['mdp'], $user['password'])) {
            array_push($erreurs, "L'ancien mot de passe est incorrect");
        }

        if($request['newmdp'] != $request['confirmmdp']) {
            array_push($erreurs, "Les nouveaux mot de passe ne sont pas identiques");
        }

        if(empty($erreurs)) {
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request['newmdp'])]);

            session()->flash('succes', 'Le mot de passe a été modifié !');
        }

        else {
            foreach ($erreurs as $erreur) {
                session()->flash('erreur', $erreur);
            }
        }

        return redirect()->route('profilMdp');
    }

    public function show($id) {
        $userId = Auth::id();

        $user = User::select('name', 'email', 'created_at', 'id')->where('users.id', $id)->first();

        $publications = Publication::join('users', 'users.id', '=', 'publications.user_id')->select('publications.id', 'publications.message', 'publications.created_at', 'users.name', 'users.id AS idUser')->where('users.id', $id)->orderBy('publications.created_at')->get();

        $follow = Follow::where('user_id', $userId)->where('user_id_2', $user['id'])->count();

        $nbAbonnements = Follow::where('user_id', $id)->count();
        $nbAbonnes = Follow::where('user_id_2', $id)->count();

        return view('profil.show', compact('user', 'publications', 'follow', 'nbAbonnements', 'nbAbonnes'));
    }
}
