<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    /**
     * Shows homepage.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
      $featured_id = App\Bid::groupBy('auction_id')->orderBy('count(*)')->select('auction_id');
      $featured = App\Auction::whereIn('id', $featured_id);
      return view('pages.home', ['featured_id' => $featured_id, 'featured => $featured']);
    }
}
