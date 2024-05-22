<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Auth\Access\HandlesAuthorization;

class WishlistPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Wishlist $wishlist)
    {
        return $user->id === $wishlist->user_id;
    }
}
