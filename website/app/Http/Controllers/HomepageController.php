<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Bid;
use App\Category;
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
      $featured_id = Bid::groupBy('auction_id')->orderBy(DB::raw('count(*)'), 'DESC')->select('auction_id');
      $featured = Auction::whereIn('id', $featured_id);
      $categories = Category::all();
      return view('pages.home', ['featured_id' => $featured_id, 'featured' => $featured, 'categories' => $categories]);
    }
}
