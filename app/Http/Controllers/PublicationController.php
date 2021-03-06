<?php

namespace App\Http\Controllers;

use App\Like;
use App\Publication;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $userId = Auth::id();

        $likeBool = false;

        $publications = Publication::join('users', 'users.id', '=', 'publications.user_id')->join('follows', 'follows.user_id_2', 'users.id')->select('publications.id', 'publications.message', 'publications.created_at', 'users.name', 'users.id AS idUser', 'users.avatar')->where('follows.user_id', $userId)->orderBy('publications.created_at', 'DESC')->get();

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

        $currentUsers = User::join('role_user', 'users.id', '=', 'role_user.user_id')->join('roles', 'roles.id', '=', 'role_user.role_id')->select('roles.name')->where('users.id', $userId)->get();

        return view('publications.index', compact('publications', 'currentUsers'));
    }

    public function store(Request $request) {
        $userId = Auth::id();

        $publication = Publication::create([
            'message' => $request->input('message'),
            'user_id' => $userId
        ]);

        $publication->save();

        session()->flash('succes', 'La publication a été posté avec succès !');

        return redirect()->route('publication');
    }

    public function delete($id) {
        $publication = Publication::where('publications.id', $id)->first();

        $publication->delete();

        session()->flash('succes', 'La publication a été supprimé !');

        return redirect()->route('publication');
    }

    public function like($id) {
        $userId = Auth::id();

        $like = Like::where('user_id', $userId)->where('publication_id', $id)->first();

        if($like) {
            $like->delete();
        }

        else {
            $like = Like::create([
                'user_id' => $userId,
                'publication_id' => $id,
            ]);

            $like->save();
        }

        //return redirect()->route('publication');
        return redirect()->back();
    }

    public function show($id) {
        $userId = Auth::id();

        $likeBool = false;

        $publication = Publication::join('users', 'users.id', '=', 'publications.user_id')->join('follows', 'follows.user_id_2', 'users.id')->select('publications.id', 'publications.message', 'publications.created_at', 'users.name', 'users.id AS idUser', 'users.avatar')->where('publications.id', $id)->first();

        $likes = Like::join('users', 'users.id', '=', 'likes.user_id')->select('users.id AS userId', 'name', 'avatar')->where('likes.publication_id', $publication['id'])->get();

        $likesUser = Like::where('publication_id', $publication['id'])->where('user_id', $userId)->count();

        if($likesUser > 0) {
            $likeBool = true;
        }

        $publication['likes'] = $likes;
        $publication['likeBool'] = $likeBool;

        $currentUsers = User::join('role_user', 'users.id', '=', 'role_user.user_id')->join('roles', 'roles.id', '=', 'role_user.role_id')->select('roles.name')->where('users.id', $userId)->get();

        return view('publications.show', compact('publication', 'currentUsers'));
    }
}
