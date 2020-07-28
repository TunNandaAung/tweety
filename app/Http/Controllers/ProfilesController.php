<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', [
            'user' => $user,
            'tweets' => $user->tweets()->paginate(50),
            'followings' => $user->follows->count(),
            'followers' => $user->followers->count()
        ]);
    }

    public function edit(User $user)
    {
        //$this->authorize('edit',$user);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user), 'alpha_dash'],
            'avatar' => ['file'],
            'banner' => ['file'],
            'description' => ['sometimes', 'string'],
        ]);

        if (request('avatar')) {
            $attributes['avatar'] = request('avatar')->store('avatars');
        }

        if (request('banner')) {
            $attributes['banner'] = request('banner')->store('banners');
        }


        $user->update($attributes);

        return redirect($user->path())->with('flash', 'Your profile has been updated!');
    }
}
