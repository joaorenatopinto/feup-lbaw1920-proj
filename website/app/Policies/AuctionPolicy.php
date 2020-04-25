<?php

namespace App\Policies;

use App\User;
use App\Auction;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AuctionPolicy
{
  use HandlesAuthorization;

  public function create(User $user)
  {
    return $user->id > 0;
  }

  public function edit(User $user, Auction $auction)
  {
    return $user->id === $auction->user_id;
  }
}
