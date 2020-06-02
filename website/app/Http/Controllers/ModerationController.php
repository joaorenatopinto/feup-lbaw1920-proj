<?php

namespace App\Http\Controllers;

use App\AuctionStatus;
use App\User;
use App\UserStatus;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModerationController extends Controller
{
  public function showUsers() {
    $this->authorize('mod', Auth::user());

    $users = User::orderBy('id')->paginate(10);

    return view('moderation.users', ['users' => $users]);
  }

  public function showAuctions() {
    $this->authorize('mod', Auth::user());
    return view('pages.moderation,auctions');
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

  public function cancelAuction(Request $request, $auctionId) {
    $status = new AuctionStatus();

    if (Auth::guard('admin')->check()) {
      $status->admin_id = Auth::guard('admin')->id();
    }
    else if (Auth::user()->can('cancelAuction',$auctionId)) {
      $status->moderator = Auth::id();
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
