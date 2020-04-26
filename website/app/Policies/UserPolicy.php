<?php

namespace App\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
  use HandlesAuthorization;

  public function edit(User $user1, USer $user2)
  {
    return $user1->id === $user2->id;
  }
}
