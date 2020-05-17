<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuctionController extends Controller
{
  public function show($id)
  {
    $auction = Auction::find($id);
    return view('pages.auction', ['auction' => $auction]);
  }

  public function showCreateForm()
  {
    $this->authorize('create', Auction::class);
    return view('pages.create_auction');
  }

  public function create(Request $request)
  {
    $this->authorize('create', Auction::class);

    $now = date('Y-m-d');
    $categories = DB::select('select name from category', []);

    $this->validate($request, [
      'title' => 'bail|required|max:255',
      'description' => 'bail|required|max:1500',
      'closeDate' => 'bail|required|date_format:Y-m-d|after:' . $now,
      'initialValue' => 'bail|required|min:5',
      'category' => ['bail', 'required', Rule::in($categories)]
    ]);

    $category_id = Category::where('name',$request['category'])->first();

    $auction = new Auction;

    $auction->title = $request['title'];
    $auction->description = $request['description'];
    $auction->closedate = $request['closeDate'];
    $auction->initialvalue = $request['initialValue'];
    $auction->category_id = $category_id->id;
    $auction->user_id = Auth::user()->id;

    print($auction);

    $auction->save();

    return redirect()->route('auction', ['id' => $auction->id]);
  }

  public function showEditForm($id)
  {
    $auction = Auction::find($id);
    $this->authorize('edit', $auction);
    return view('pages.edit_auction', ['auction' => $auction]);
  }

  public function edit(Request $request, $id)
  {
    $auction = Auction::find($id);
    $this->authorize('edit', $auction);
    $categories = DB::select('select name from category', []);
    $this->validate($request, [
      'title' => 'bail|required|max:255',
      'description' => 'bail|required|max:1500',
      'category' => ['bail', 'required', Rule::in($categories)]
    ]);

    $auction->title = $request->title;
    $auction->description = $request->description;

    return back();
  }

  public function bid(Request $request, $id)
  {
    $auction = Auction::find($id);
    $this->authorize('bid', $auction);
    $max = $auction->getHighestBid($id);

    /* increment of 1 */
    $min_bid = $max + 1;


    $this->validate($request, [
      'value' => ['bail', 'required', 'min:' . $min_bid]
    ]);

    $bid = new Bid;
    $bid->value = $request->value;
    $bid->user_id = Auth::user()->id;
    $bid->auction_id = $id;
    $bid->save();
  }
}
