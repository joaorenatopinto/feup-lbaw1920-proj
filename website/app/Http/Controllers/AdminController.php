<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Auction;
use App\AuctionStatus;
use App\User;
use App\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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

  public function mods(Request $request) {
    if (Auth::guard('admin')->check()) {
      $userStatus = UserStatus::all();
      $auctionStatus = AuctionStatus::all();
      $allStatus = $userStatus->merge($auctionStatus)->sortByDesc('datechanged')->filter(function ($value, $key) {
        return $value['admin_id'] != null || $value['moderator_id'] != null;
      });      

      $perPage = 10;
      $page = $request['page'];

      $pagination = new LengthAwarePaginator(
        $allStatus->forPage($page,$perPage),
        $allStatus->count(),
        $perPage,
        $page,
        ['path' => route('adminMods')]
      );

      return view('admin.mods', ['actions' => $pagination]);
    }

    return redirect(route('home'));
  }
}
