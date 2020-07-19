<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;

class EmailController extends BaseApiController
{
    public function update()
    {
        $attributes = request()->validate([
            'email' => ['email','required', Rule::unique('users')->ignore(current_user())],
            'password' => ['required', new MatchOldPassword],
        ]);


        current_user()->update([
            'email' => $attributes['email']
        ]);

        return $this->sendResponse(current_user(), 'success', 201);
    }
}
