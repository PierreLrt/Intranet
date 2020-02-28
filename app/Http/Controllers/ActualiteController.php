<?php

namespace App\Http\Controllers;

use App\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActualiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('actualites.create');
    }

    public function store(Request $request) {
        $userId = Auth::id();

        $actualite = Actualite::create([
            'titre' => $request->input('titre'),
            'contenu' => $request->input('contenu'),
            'user_id' => $userId
        ]);

        $actualite->save();

        session()->flash('succes', 'L\'actualité a été créé !');

        return redirect()->route('actualiteCreate');
    }

    public function edit($id) {
        $actualite = Actualite::where('actualites.id', $id)->first();

        return view('actualites.edit', compact('actualite'));
    }

    public function update($id, Request $request) {
        $actualite = Actualite::where('actualites.id', $id)->first();

        $actualite['titre'] = $request->input('titre');
        $actualite['contenu'] = $request->input('contenu');

        $actualite->save();

        session()->flash('succes', 'L\'actualité a été édité !');

        return redirect()->route('actualiteEdit', $id);
    }

    public function delete($id) {
        $actualite = Actualite::where('actualites.id', $id)->first();

        $actualite->delete();

        session()->flash('succes', 'L\'actualité a été supprimé !');

        return redirect()->route('home');
    }
}
