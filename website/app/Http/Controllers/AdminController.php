<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

  public function users()
  {
    if (Auth::guard('admin')->check()) {
      $users = User::paginate(5);

      return view('admin.users', ['users' => $users]);
    }

    return redirect(route('home'));
  }
}
