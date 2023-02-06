<?php

namespace App\Policies;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy {

    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(?User $user, Topic $topic): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Topic $topic): bool
    {
        return $topic->user_id === $user->id;
    }

    public function delete(User $user, Topic $topic): bool
    {
        return $this->update($user, $topic);
    }

}
