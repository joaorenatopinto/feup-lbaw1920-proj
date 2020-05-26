<?php

namespace App\Http\Controllers;

use App\User;

class AdminController extends Controller
{

  public function users()
  {
    $users = User::paginate(5);

    return view('admin.users', ['users' => $users]);
  }
}
