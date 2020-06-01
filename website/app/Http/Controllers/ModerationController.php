<?php

namespace App\Http\Controllers;

use App\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModerationController extends Controller
{
  //TODO FIX POLICIES
    public function showUsers() {
      $this->authorize('mod');
      return view('pages.moderation_users');
    }

    public function showAuctions() {
      $this->authorize('mod');
      return view('pages.moderation_auctions');
    }

    public function showReports() {
      $this->authorize('mod');
      return view('pages.moderation_reports');
    }
     
    public function banUser(Request $request, $userId) {
      //TODO now only works for admins

      if (Auth::guard('admin')->check()) {
        $status = new UserStatus;

        if ($request['ban'] == '1') {
          //ban the user
          $status->status = 'banned';
          $status->datechanged = date("Y-m-d H:i:s");
          $status->user_id = $userId;
          $status->admin_id = Auth::guard('admin')->id();

          $status->save();

          return redirect()->back();
        }
        else {
          //Unban the user
          $status->status = 'active';
          $status->datechanged = date("Y-m-d H:i:s");
          $status->user_id = $userId;
          $status->admin_id = Auth::guard('admin')->id();

          $status->save();

          return redirect()->back();
        }
      }

      return redirect(route('home'));
    }

    public function cancelAuction() {
      $this->authorize('mod');
      // do stuff
    }
}
