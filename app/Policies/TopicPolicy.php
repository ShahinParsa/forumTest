<?php

namespace App\Policies;

use App\User;
use App\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;


    public function update(User $user, Topic $topic)
    {
        //

        return ($topic->user->id == $user->id || $user->user_role == 'admin' || $user->user_role == 'moderator' );

    }


    public function delete(User $user, Topic $topic)
    {
        //

        return ($topic->user->id == $user->id || $user->user_role == 'admin' || $user->user_role == 'moderator' );
    }

}
