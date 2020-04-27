<?php

namespace App\Http\Controllers;

use App\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

  public function show($id)
  {
    $auctions = Auction::where('category_id', $id)->paginate(3);

    return view('pages.auctionsInCategory', compact('auctions', 'id'));
  }
  
  public function getCategoryPageAjax(Request $request, $id) {
    $auctions = Auction::where('category_id', $id)->paginate(3);

    $bids = [];

    //Get highest bid for each auction
    foreach ($auctions as $auction) {
      $auct_id = $auction->id;
      $bids[$auct_id] = $auction->getHighestBid();
    }


    return json_encode(['auctions' => $auctions, 'bids' => $bids]);
  }
}
