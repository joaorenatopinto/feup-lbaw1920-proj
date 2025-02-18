<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Auction;
use App\AuctionStatus;
use App\Category;
use App\Report;
use App\User;
use App\UserStatus;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    throw new AuthorizationException;
  }

  public function auctions(Request $request) {
    if (Auth::guard('admin')->check()) {
      if($request->filled('auction')) {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~', '\'', '|', '&'];
      $term= str_replace($reservedSymbols, '',$request['auction']);

      $auctions = DB::select("select id, ts_rank_cd(search1 || search2,\"query\") AS \"rank\" FROM auction, to_tsquery(?) AS \"query\", setweight(to_tsvector('english',auction.title), 'A') AS search1, setweight(to_tsvector('english',auction.description), 'B') AS search2 WHERE search1 || search2  @@ \"query\" ORDER BY \"rank\" DESC",[$term]);


      if(sizeof($auctions) == 0)
      return view('pages.fail_search');

      $collection = collect([Auction::find($auctions[0]->id)]);

      for($i = 1; $i < sizeof($auctions); $i++) {
        $collection->add(Auction::find($auctions[$i]->id));
      }

      $perPage = 9;
      $page = $request['page'];

      $pagination = new LengthAwarePaginator(
        $collection->forPage($page,$perPage),
        $collection->count(),
        $perPage,
        $page
      );

      $auctions = $pagination;
      } else {
        $auctions = Auction::orderBy('id')->paginate(10);
      }

      return view('admin.auctions', ['auctions' => $auctions]);
    }

    throw new AuthorizationException;
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
        $page
      );

      return view('admin.mods', ['actions' => $pagination]);
    }

    throw new AuthorizationException;
  }

  public function stats() {
    if(Auth::guard('admin')->check()) { 

      return view('admin.statistics');
    }

    throw new AuthorizationException;
  }

  public function reports(Request $request) {
    if(Auth::guard('admin')->check()) {
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

      return view('admin.reports',['reports' => $pagination]);
    }

    return new AuthorizationException();
  }

  public function getStats() {
    if(Auth::guard('admin')->check()) { 
      $auctionsPerCategory = DB::table('category')->join('auction','category.id','auction.category_id')
      ->select('name',DB::raw('count(auction.id) as auctions'))->groupBy('category.name')->get();

      $bids = Category::all();
      $auctions = Auction::all();

      //Set count to 0
      foreach ($bids as $bid) {
        $bid['total'] = 0;
      }

      foreach ($auctions as $auction) {
        $bids[$auction->category_id-1]['total'] += Auction::find($auction['id'])->getHighestBid();
      }

      return json_encode(['auctions' => $auctionsPerCategory, 'bids' => $bids]);
    }

    throw new AuthorizationException;
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

    throw new AuthorizationException;
  }
}
