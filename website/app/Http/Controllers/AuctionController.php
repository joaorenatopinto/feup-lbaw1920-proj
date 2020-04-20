<?php

namespace App\Http\Controllers;

use App\Auction;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
  /**
   * Creates a new auction.
   *
   * @param  Request request containing the information
   * @return Response
   */
  public function create(Request $request)
  {
    $auction = new Auction();

    /* $this->authorize('create', $item);

    $item->done = false;
    $item->description = $request->input('description');
    $item->save(); */

    return $auction;
  }

  /**
   * Shows the auction for a given id.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $auction = Auction::find($id);
    $this->authorize('auction', $auction);
    return view('pages.auction', ['auction' => $auction]);
  }

  /**
   * Bid in the auction for a given id.
   *
   * @param  int  $id
   * @return Response
   */
  public function bid($id)
  {
    $auction = Auction::find($id);
    $this->authorize('bid', $auction);
    return view('pages.auction', ['auction' => $auction]);
  }

  /**
   * Review the auction for a given id.
   *
   * @param  int  $id
   * @return Response
   */
  public function review($id)
  {
    $auction = Auction::find($id);
    $this->authorize('bid', $auction);
    return view('pages.auction', ['auction' => $auction]);
  }

  /**
   * Search auction for a given term.
   *
   * @param  int  $term
   * @return Response
   */
  public function search($term)
  {
    $auctions = Auction::search($term);


    return view('pages.search', ['auctions' => $auctions]);
  }

  /**
   * Follow auction for a given id.
   *
   * @param  int  $id
   * @return Response
   */
  public function follow(Request $request, $id)
  {
    $auction = Auction::find($id);
    $this->authorize('follow', $auction);
    return view('pages.auction', ['auction' => $auction]);
  }
}
