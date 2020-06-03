<?php

namespace App\Http\Controllers;

use App\Auction;
use App\AuctionStatus;
use App\Report;
use App\ReportStatus;
use App\User;
use App\UserStatus;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Pagination\LengthAwarePaginator;
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

    $auctions = Auction::orderBy('id')->paginate(10);

    return view('moderation.auctions',['auctions' => $auctions]);
  }

  public function showReports(Request $request) {
    $this->authorize('mod', Auth::user());

    //we reverse report order so that the most recent reports (higher id)
    //show first
    $reports = Report::orderBy('id')->get()->reverse();

    $perPage = 10;
    $page = $request['page'];

    $pagination = new LengthAwarePaginator(
      $reports->forPage($page,$perPage),
      $reports->count(),
      $perPage,
      $page
    );

    return view('moderation.reports',['reports' => $pagination]);
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

  public function reportPage($id) {
    if (Auth::user()->can('mod', User::class) || Auth::guard('admin')->check()) {
      $report = Report::find($id);

      //mark the report as seen if not seen yet
      if ($report->getLastStatus()->type == 'notSeen') {
        $status = new ReportStatus();
        $status->type = 'seen';
        $status->datechanged = date("Y-m-d H:i:s");
        $status->report_id = $id;

        if (Auth::user()->can('mod', User::class)) {
          $status->moderator_id = Auth::id();
        }
        else {
          $status->admin_id = Auth::guard('admin')->id();
        }

        $status->save();
      }

      return view('moderation.reportPage',['report' => $report]);
    }
    
    throw new AuthorizationException();
  }


  public function closeReport(Request $request, $id) {
    $status = new ReportStatus();

    if (Auth::guard('admin')->check()) {
      $status->admin_id = Auth::guard('admin')->id();
    }
    else if (($request['close'] == '1' && Auth::user()->can('close',Report::find($id))) ||
      ($request['close'] == '0' && Auth::user()->can('reopen',Report::find($id)))) {

      $status->moderator_id = Auth::id();
    }
    else {
      throw new AuthorizationException;
    }

    $status->datechanged = date("Y-m-d H:i:s");
    $status->report_id = $id;
      
    if ($request['close'] == '1') {
      //cancel the auction
      $status->type = 'closed';
    }
    else if ($request['close'] == '0') {
      //uncancel the auction
      $status->type = 'notSeen';
    }
    else {
      throw new AuthorizationException;
    }

    $status->save();
        
    return redirect()->back();
  }
}
