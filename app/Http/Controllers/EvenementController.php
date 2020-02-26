<?php

namespace App\Http\Controllers;

use App\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvenementController extends Controller
{
    public function index() {
        $evenements = Evenement::join('users', 'users.id', '=', 'evenements.user_id')->select('evenements.date_debut', 'evenements.date_fin', 'evenements.intitule', 'evenements.description','evenements.id', 'users.name')->orderBy('evenements.date_debut')->get();

        return view('evenements.index', compact('evenements'));
    }

    public function create() {
        return view('evenements.create');
    }

    public function store(Request $request) {
        $userId = Auth::id();

        $evenement = Evenement::create([
            'intitule' => $request->input('intitule'),
            'description' => $request->input('description'),
            'date_debut' => $request->input('date_debut'),
            'date_fin' => $request->input('date_fin'),
            'user_id' => $userId,
        ]);

        session()->flash('succes', 'L\'évenement a été posté avec succès !');

        return redirect()->route('evenementCreate');
    }

    public function edit($id) {
        $evenement = Evenement::where('evenements.id', $id)->first();

        return view('evenements.edit', compact('evenement'));
    }

    public function update($id, Request $request) {
        $evenement = Evenement::where('evenements.id', $id)->first();

        $evenement['intitule'] = $request->input('intitule');
        $evenement['description'] = $request->input('description');
        $evenement['date_debut'] = $request->input('date_debut');
        $evenement['date_fin'] = $request->input('date_fin');

        $evenement->save();

        session()->flash('succes', 'L\'évenement a été édité !');

        return redirect()->route('evenementEdit', $id);
    }

    public function delete($id) {
        $evenement = Evenement::where('evenements.id', $id)->first();

        $evenement->delete();

        session()->flash('succes', 'L\'évenement a été supprimé !');

        return redirect()->route('evenements');
    }
}
