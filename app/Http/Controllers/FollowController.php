<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function follow($id) {
        $userId = Auth::id();

        $follow = Follow::where('user_id', $userId)->where('user_id_2', $id)->count();

        if($follow == 0) {
            if($userId != $id) {
                Follow::create([
                    'user_id' => $userId,
                    'user_id_2' => $id
                ]);
            }

            else {
                session()->flash('erreur', 'Vous ne pouvez pas vous suivre vous-même');
            }
        }

        return redirect()->route('profilShow', $id);
    }

    public function unfollow($id) {
        $userId = Auth::id();

        $follow = Follow::where('user_id', $userId)->where('user_id_2', $id)->first();

        $follow->delete();

        return redirect()->route('profilShow', $id);
    }
}
