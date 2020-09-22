<?php

namespace App\Policies;

use App\User;
use App\UserAddress;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAddressPolicy
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

    public function own(User $user,UserAddress $address)
    {
        return $address->user_id==$user->id;
    }
}
