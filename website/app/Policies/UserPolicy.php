<?php

namespace App\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
  use HandlesAuthorization;

  //Verifies if the user is authenticated
  public function edit()
  {
    return Auth::check();
  }

  public function mod(User $user) {
    return $user->getLastStatus()->status == 'moderator';
  }
}
