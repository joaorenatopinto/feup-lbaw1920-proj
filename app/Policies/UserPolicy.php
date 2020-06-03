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
   * The mod is a moderator
   * The user is already banned
   */
  public function unban(User $mod, User $user) {
    return $mod->getLastStatus()->status == 'moderator' && 
      $user->getLastStatus()->status == 'banned';
  }


  /**
   * The mod is a moderator
   * The user is active
   */
  public function recommend(User $mod, User $user) {
    return $mod->getLastStatus()->status == 'moderator' &&
      $user->getLastStatus()->status == 'active';
  }

  /**
   * The mod is a mod
   * The user is recoMod
   * The recommendation was made by the mod
   */
  public function cancelRecommendation(User $mod, User $user) {
    return $mod->getLastStatus()->status == 'moderator' &&
      $user->getLastStatus()->status == 'recoMod';
      $user->getLastStatus()->moderator_id == $mod->id;
  }
}
 