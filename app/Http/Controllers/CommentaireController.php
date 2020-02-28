<?php

namespace App\Http\Controllers;

use App\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        $userId = Auth::id();

        $commentaire = Commentaire::create([
            'message' => $request->input('message'),
            'user_id' => $userId,
            'actualite_id' => $request->input('actualiteid')
        ]);

        $commentaire->save();

        session()->flash('succes', 'Votre commentaire a été posté avec succès !');

        return redirect()->route('home');
    }

    public function delete($id) {
        $commentaire = Commentaire::where('commentaires.id', $id)->first();

        $commentaire->delete();

        session()->flash('succes', 'Le commentaire a été supprimé !');

        return redirect()->route('home');
    }
}
