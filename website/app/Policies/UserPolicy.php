<?php

namespace App\Policies;

use App\Auction;
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

  /**
   * Only a moderator can ban a user
   * The user must not be a moderator 
   * The user must not be already banned
   */
  public function ban(User $mod, User $user) {
    return $mod->getLastStatus()->status == 'moderator' && 
      $user->getLastStatus()->status != 'moderator' && 
      $user->getLastStatus()->status != 'banned';
  }

  /**
   * The user is a moderator
   * The user is already banned
   */
  public function unban(User $mod, User $user) {
    return $mod->getLastStatus()->status == 'moderator' && 
      $user->getLastStatus()->status == 'banned';
  }

  public function closeAuction(User $mod, $auctionId) {
    $auction = Auction::find($auctionId);
  }
}
 