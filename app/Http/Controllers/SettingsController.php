<?php

namespace App\Http\Controllers;

use App\User;

class SettingsController extends Controller
{
    public function edit(User $user)
    {
        return view('settings.show', compact('user'));
    }
}
