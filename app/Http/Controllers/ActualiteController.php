<?php

namespace App\Http\Controllers;

use App\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActualiteController extends Controller
{

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

        return redirect()->route('actualiteCreate');
    }
}
