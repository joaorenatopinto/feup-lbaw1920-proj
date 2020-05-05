<?php

namespace App\Policies;

use App\User;
use App\Auction;
use App\Bid;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AuctionPolicy
{
  use HandlesAuthorization;

  public function create()
  {
    return Auth::check();
  }

  public function edit(User $user, Auction $auction)
  {
    return $user->id === $auction->user_id;
  }

  public function bid(User $user, Auction $auction)
  {
    return $user->id !== $auction->user_id;
  }

  public function review(User $user, Auction $auction)
  {
    $price = Bid::where('auction_id', $auction->id)->max('value');
    $winner_id = Bid::where('auction_id', $auction->id)->where('value', $price)->first();
    return $user->id !== $winner_id;
  }
}
