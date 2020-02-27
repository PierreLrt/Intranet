<?php

namespace App\Http\Controllers;

use App\Evenement;
use App\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvenementController extends Controller
{
    public function index() {
        $evenements = Evenement::join('users', 'users.id', '=', 'evenements.user_id')->select('evenements.date_debut', 'evenements.date_fin', 'evenements.intitule', 'evenements.description','evenements.id', 'users.name')->orderBy('evenements.date_debut')->get();

        foreach ($evenements as $evenement) {
            $participants = Participant::join('users', 'users.id', '=', 'participants.user_id')->where('evenement_id', $evenement['id'])->where('statut', 1)->get();
            $enAttentes = Participant::join('users', 'users.id', '=', 'participants.user_id')->where('evenement_id', $evenement['id'])->where('statut', 2)->get();
            $nonParticipants = Participant::join('users', 'users.id', '=', 'participants.user_id')->where('evenement_id', $evenement['id'])->where('statut', 3)->get();

            $evenement['participants'] = $participants;
            $evenement['enAttentes'] = $enAttentes;
            $evenement['nonParticipants'] = $nonParticipants;
        }

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

    public function participer($idEvenement, $idParticipation) {
        $userId = Auth::id();

        if($idParticipation == 1 || $idParticipation == 2 || $idParticipation == 3) {

            $participants = Participant::where('participants.evenement_id', $idEvenement)->where('participants.user_id', $userId)->get();

            //dd($participant->count());
            if($participants->count() > 0) {
                foreach ($participants as $participant) {
                    Participant::where('id', $participant['id'])->delete();
                }
            }

            Participant::create([
                'statut' => $idParticipation,
                'evenement_id' => $idEvenement,
                'user_id' => $userId
            ]);

            session()->flash('succes', 'Votre réponse a été pris en compte, merci !');
        }

        return redirect()->route('evenements');
    }
}
