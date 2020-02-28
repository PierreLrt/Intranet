<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = false;

        $userId = Auth::id();

        $users = User::join('role_user', 'users.id', '=', 'role_user.user_id')->join('roles', 'roles.id', '=', 'role_user.role_id')->where('users.id', $userId)->get();

        foreach ($users as $user) {
            if($user['name'] === 'Administrateur') {
                $admin = true;
            }
        }

        if ($admin) {
            return $next($request);
        }
        return redirect()->route('home');
    }
}
