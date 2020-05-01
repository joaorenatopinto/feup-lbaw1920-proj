<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ModerationController extends Controller
{
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

    public function banUser() {
      $this->authorize('mod');
      // do stuff
    }

    public function cancelAuction() {
      $this->authorize('mod');
      // do stuff
    }
}
