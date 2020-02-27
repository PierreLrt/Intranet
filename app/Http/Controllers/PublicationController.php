<?php

namespace App\Http\Controllers;

use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    public function index() {
        $publications = Publication::join('users', 'users.id', '=', 'publications.user_id')->select('publications.id', 'publications.message', 'publications.created_at', 'users.name')->orderBy('publications.created_at')->get();

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
}
