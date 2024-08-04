<?php

namespace App\Policies;

use App\Models\ReviewLesson;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, ReviewLesson $review)
    {
        return $user->id === $review->user_id;
    }

    public function delete(User $user, ReviewLesson $review)
    {
        return $user->id === $review->user_id;
    }

}
