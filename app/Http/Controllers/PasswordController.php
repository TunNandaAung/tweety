<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\User;

class PasswordController extends Controller
{
    public function edit(User $user)
    {
        return view('settings.password.edit', compact('user'));
    }

    public function update(User $user)
    {
        request()->validate([
            'current_password' => ['required', 'string', 'min:8', new MatchOldPassword],
            'new_password' =>  ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user->update([
            'password' => request('new_password')
        ]);

        return redirect($user->path('settings'))->with('flash', 'Your password has been updated!');
    }
}
