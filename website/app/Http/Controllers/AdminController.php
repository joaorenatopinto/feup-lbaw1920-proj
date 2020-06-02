<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Auction;
use App\AuctionStatus;
use App\User;
use App\UserStatus;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

//Note: we can not use policies for admins because they use a custom guard

class AdminController extends Controller {

  public function users(Request $request) {
    if(Auth::guard('admin')->check()) {
      if($request->filled('username')) {
        $term = $request->username;
        $users = User::search($term)->paginate(10);
      } else {
        $users = User::orderBy('id')->paginate(10);
      }

      return view('admin.users', ['users' => $users]);
    }

    return redirect()->route('home');
  }

  public function auctions(Request $request) {
    if (Auth::guard('admin')->check()) {
      if($request->filled('auction')) {
        $term = $request->auction;
        $auctions = Auction::search($term)->paginate(10);
      } else {
        $auctions = Auction::orderBy('id')->paginate(10);
      }

      return view('admin.auctions', ['auctions' => $auctions]);
    }

    return redirect()->route('home');
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

    return redirect()->route('home');
  }

  public function promote(Request $request, $userId) {
    if (Auth::guard('admin')->check()) {
      $status = new UserStatus;

      if ($request['promote'] == '1') {
        //promote the user
        $status->status = 'moderator';
        $status->datechanged = date("Y-m-d H:i:s");
        $status->user_id = $userId;
        $status->admin_id = Auth::guard('admin')->id();

        $status->save();

        return redirect()->back();
      }
      else {
        //demote the user
        $status->status = 'active';
        $status->datechanged = date("Y-m-d H:i:s");
        $status->user_id = $userId;
        $status->admin_id = Auth::guard('admin')->id();

        $status->save();

        return redirect()->back();
      }
    }

    return redirect()->route('home');
  }
}
