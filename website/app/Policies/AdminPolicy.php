<?php

namespace App\Policies;

use App\Admin;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AdminPolicy
{
  use HandlesAuthorization;

  //Verifies if the admin is authenticated
  public function login()
  {
    return true;
  }

  public function access(Admin $admin) {
      return Auth::guard('admin')->check();
  }
}
