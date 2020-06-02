<?php

namespace App\Http\Controllers;

use App\Auction;
use App\AuctionStatus;
use App\User;
use App\UserStatus;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModerationController extends Controller
{
  public function showUsers(Request $request) {
    $this->authorize('mod', Auth::user());
    if($request->filled('username')) {
      $term = $request->username;
      $users = User::search($term)->paginate(10);
    } else {
      $users = User::orderBy('id')->paginate(10);
    }

    return view('moderation.users', ['users' => $users]);
  }

  public function showAuctions(Request $request) {
    $this->authorize('mod', Auth::user());
    if($request->filled('auction')) {
      $term = $request->auction;
      $auctions = Auction::search($term)->paginate(10);
    } else {
      $auctions = Auction::orderBy('id')->paginate(10);
    }

    return view('moderation.auctions',['auctions' => $auctions]);
  }

  public function showReports() {
    $this->authorize('mod', Auth::user());
    return view('pages.moderation_reports');
  }

  public function banUser(Request $request, $userId) {
    $status = new UserStatus;

    if (Auth::guard('admin')->check()) {
      $status->admin_id = Auth::guard('admin')->id();
    }
    else if (($request['ban'] == '1' && Auth::user()->can('ban',User::find($userId))) ||
      ($request['ban'] == '0' && Auth::user()->can('unban',User::find($userId))) ) {
      $status->moderator_id = Auth::id();
    }
    else {
      throw new AuthorizationException;
    }

    $status->datechanged = date("Y-m-d H:i:s");
    $status->user_id = $userId;

    if ($request['ban'] == '1') {
      //ban the user
      $status->status = 'banned';
    }
    else if ($request['ban'] == '0')  {
      //Unban the user
      $status->status = 'active';
    }
    else {
      throw new AuthorizationException;
    }

    $status->save();

    return redirect()->back();
  }

  public function recommendMod(Request $request, $userId) {
    if (($request['recommend'] == '1' && Auth::user()->can('recommend',User::find($userId))) ||
      ($request['recommend'] == 0 && Auth::user()->can('cancelRecommendation',User::find($userId)))) {

      $status = new UserStatus();

      $status->moderator_id = Auth::id();
      $status->datechanged = date("Y-m-d H:i:s");
      $status->user_id = $userId;

      if ($request['recommend'] == '1') {
        $status->status = 'recoMod';
      }
      else if ($request['recommend'] == '0') {
        $status->status = 'active';
      }
      else {
        throw new AuthorizationException;
      }

      $status->save();

      return redirect()->back();
    }
    else {
      throw new AuthorizationException;
    }
  }

  public function cancelAuction(Request $request, $auctionId) {
    $status = new AuctionStatus();

    if (Auth::guard('admin')->check()) {
      $status->admin_id = Auth::guard('admin')->id();
    }
    else if (($request['cancel'] == '1' && Auth::user()->can('cancel',Auction::find($auctionId))) ||
      ($request['cancel'] == '0' && Auth::user()->can('undoCancel',Auction::find($auctionId)))) {

      $status->moderator_id = Auth::id();
    }
    else {
      throw new AuthorizationException;
    }

    $status->datechanged = date("Y-m-d H:i:s");
    $status->auction_id = $auctionId;

    if ($request['cancel'] == '1') {
      //cancel the auction
      $status->status = 'removed';
    }
    else if ($request['cancel'] == '0') {
      //uncancel the auction
      $status->status = 'ongoing';
    }
    else {
      throw new AuthorizationException;
    }

    $status->save();

    return redirect()->back();
  }
}
