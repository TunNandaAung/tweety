<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Validation\Rule;

class EmailController extends Controller
{
    public function edit(User $user)
    {
        return view('settings.email.edit', compact('user'));
    }

    public function update(User $user)
    {
        request()->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
         
        ]);

        $user->update([
            'email' => request('email')
        ]);

        return redirect($user->path('settings'))->with('flash', 'Your email has been updated!');
    }
}
