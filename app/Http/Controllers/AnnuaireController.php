<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AnnuaireController extends Controller
{
    public function index() {
        $users = User::paginate(12);

        return view('annuaires.index', compact('users'));
    }
}
