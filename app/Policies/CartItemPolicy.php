<?php

namespace App\Policies;

use App\CartItem;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartItemPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function own(User $user,CartItem $cart)
    {
        return $user->id==$cart->user_id;
    }
}
