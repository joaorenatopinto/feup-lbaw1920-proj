<?php

namespace App\Policies;

use App\User;
use App\Auction;
use App\Bid;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ModerationPolicy
{
  use HandlesAuthorization;

  public function mod(User $user)
  {
    $current_user_id = $user->id;
    $status = DB::select('select status from user_status where user_id = ?', [$current_user_id]);
    return $status === 'mod';
  }
}
