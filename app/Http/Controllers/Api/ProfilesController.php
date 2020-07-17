<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Validation\Rule;
use App\User;
use Illuminate\Support\Facades\Gate;

class ProfilesController extends BaseApiController
{
    public function index()
    {
        return $this->sendResponse(auth()->user());
    }

    public function show(User $user)
    {
        return $this->sendResponse($user);
    }

    public function update(User $user)
    {
        if (Gate::denies('edit', $user)) {
            return $this->sendError('Unauthorized!', [], 403);
        };

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

        return $this->sendResponse($user, '', 201);
    }
}
