<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Support\Facades\Storage;

class UserAvatarController extends BaseApiController
{
    public function show()
    {
        return $this->sendResponse(['avatar' => auth()->user()->avatar]);
    }
    
    public function store()
    {
        request()->validate([
            'avatar' => ['required', 'image'],
            'banner' => ['required','image'],
        ]);

        Storage::disk('public')->delete(auth()->user()->getRawOriginal('avatar'));
        
        Storage::disk('public')->delete(auth()->user()->getRawOriginal('banner'));

        auth()->user()->update([
            'avatar' => request('avatar')->store('avatars', 'public'),
            'banner' => request('banner')->store('banners', 'public')
        ]);

        return $this->sendResponse([], '', 204);
    }
}
