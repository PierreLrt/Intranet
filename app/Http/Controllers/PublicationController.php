<?php

namespace App\Http\Controllers;

use App\Publication;
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

        $publications = Publication::join('users', 'users.id', '=', 'publications.user_id')->join('follows', 'follows.user_id_2', 'users.id')->select('publications.id', 'publications.message', 'publications.created_at', 'users.name', 'users.id AS idUser')->where('follows.user_id', $userId)->orderBy('publications.created_at', 'DESC')->get();

        return view('publications.index', compact('publications'));
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
}
