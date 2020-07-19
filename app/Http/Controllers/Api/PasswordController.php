<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Rules\MatchOldPassword;

class PasswordController extends BaseApiController
{
    public function update()
    {
        request()->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|confirmed'
        ]);

        current_user()->update([
            'password' => request('new_password')
        ]);

        current_user()->tokens()->delete();

        $token = current_user()->createToken(current_user()->email)->plainTextToken;

        return $this->sendResponse($token, '', 201);
    }
}
