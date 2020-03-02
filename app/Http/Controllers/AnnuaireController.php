<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AnnuaireController extends Controller
{
    public function index() {
        $users = User::paginate(12);
        $search  = "";

        return view('annuaires.index', compact('users', 'search'));
    }

    public function search(Request $request) {
        $users = User::select('id', 'name', 'avatar')->where('name', 'LIKE', "%{$request->input('search')}%")->paginate(12);
        $search = $request->input('search');

        return view('annuaires.index', compact('users', 'search'));
    }
}
