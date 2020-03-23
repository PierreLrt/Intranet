<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Like;
use App\Publication;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $userId = Auth::id();

        $user = User::select('name', 'email', 'created_at', 'avatar')->where('users.id', $userId)->first();

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

        $domaine = explode("@", $request['newemail']);

        if(strtolower($domaine[1]) != "viacesi.fr") {
            array_push($erreurs, "L'email doit être un email CESI");
        }

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
        $currentUsers = User::join('role_user', 'users.id', '=', 'role_user.user_id')->join('roles', 'roles.id', '=', 'role_user.role_id')->select('roles.name')->where('users.id', $userId)->get();

        $user = User::select('name', 'email', 'created_at', 'id', 'avatar')->where('users.id', $id)->first();

        $publications = Publication::join('users', 'users.id', '=', 'publications.user_id')->select('publications.id', 'publications.message', 'publications.created_at', 'users.name', 'users.id AS idUser', 'users.avatar')->where('users.id', $id)->orderBy('publications.created_at')->get();

        $likeBool = false;

        foreach ($publications as $publication) {
            $likes = Like::where('publication_id', $publication['id'])->get();

            $likesUser = Like::where('publication_id', $publication['id'])->where('user_id', $userId)->count();

            if($likesUser > 0) {
                $likeBool = true;
            }

            $publication['likes'] = $likes;
            $publication['likeBool'] = $likeBool;

            $likeBool = false;
        }

        $follow = Follow::where('user_id', $userId)->where('user_id_2', $user['id'])->count();

        $nbAbonnements = Follow::where('user_id', $id)->count();
        $nbAbonnes = Follow::where('user_id_2', $id)->count();

        return view('profil.show', compact('user', 'publications', 'follow', 'nbAbonnements', 'nbAbonnes', 'currentUsers'));
    }

    public function updateAvatar(Request $request) {
        $userId = Auth::id();

        // Avatar
        request()->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dossierAvatar = 'images/avatars/';
        $imageNameAvatar = time().'.'.request()->avatar->getClientOriginalExtension();
        request()->avatar->move(public_path('images/avatars'), $imageNameAvatar);

        $user = User::where('id', $userId)->first();
        $user['avatar'] = $dossierAvatar . $imageNameAvatar;

        $user->save();

        session()->flash('succes', 'L\'avatar a été mis en ligne !');

        return redirect()->route('profil');
    }

    public function listAbonnes($id) {
        $user = User::select('id', 'name', 'avatar')->where('id', $id)->first();

        $follows = Follow::join('users', 'users.id', '=', 'follows.user_id')->select('users.id AS userId', 'name', 'avatar')->where('follows.user_id_2', $id)->get();

        return view('profil.listabonnes', compact('follows', 'user'));
    }
}
