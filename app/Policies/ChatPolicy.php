<?php

namespace App\Policies;

use App\User;
use App\Chat;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function view(User $user, Chat $chat)
    {
        return $chat->participants->contains($user);
    }
}
