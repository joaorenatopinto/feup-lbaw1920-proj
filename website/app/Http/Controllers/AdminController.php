<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Auction;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
//TODO use the policy instead of if
{

  public function users() {
    if (Auth::guard('admin')->check()) {
      $users = User::orderBy('id')->paginate(10);

      return view('admin.users', ['users' => $users]);
    }

    return redirect(route('home'));
  }

  public function auctions() {
    if (Auth::guard('admin')->check()) {
      $auctions = Auction::paginate(10);

      return view('admin.auctions', ['auctions' => $auctions]);
    }

    return redirect(route('home'));
  }

  public function mods() {
    if (Auth::guard('admin')->check()) {

      return view('admin.mods');
    }

    return redirect(route('home'));
  }
}
