<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Image;
use App\Auction;
use App\Category;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;

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

    $categories = Arr::pluck(DB::select('select name from category', []),'name');
    $this->validate($request, [
      'title' => 'bail|required|max:255',
      'description' => 'bail|required|max:1500',
      'closeDate' => 'bail|required|date_format:Y-m-d|after:' . now()->format('Y-m-d'),
      'initialValue' => 'bail|required|numeric|min:1',
      'category' => ['bail', 'required', Rule::in($categories)]
    ]);

    $category = Category::where('name',$request['category'])->first();
    $date = $request['closeDate'].' '.$request['time'];

    $auction = new Auction;
    $auction->title = $request['title'];
    $auction->description = $request['description'];
    $auction->initialvalue = $request['initialValue'];
    $auction->closedate = \Carbon\Carbon::parse($date);
    $auction->category_id = $category->id;
    $auction->user_id = Auth::user()->id;
    $auction->save();
    
    $path = '/img/auction/auction'.$auction->id.'/1.'.$request['image']->getClientOriginalExtension();
    $request['image']->move(public_path('img/auction/auction'.$auction->id), '1.' . $request['image']->getClientOriginalExtension());

    $img = new Image([
      'path' => $path,
      'alt' => "auction".$auction->id,
      'auction_id' => $auction->id,
      ]);
  $img->save();


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

    $auction->title = $request->input('title');
    $auction->description = $request->input('description');

    return back();
  }

  public function bid(Request $request, $id)
  {
    $auction = Auction::find($id);
    $this->authorize('bid', $auction);
    $max = $auction->getHighestBid();

    /* increment of 1 */
    $min_bid = $max + 1;

    $this->validate($request, [
      'value' => ['required', 'numeric' ,'min:' . $min_bid]
    ]);

    $balance = Auth::user()->balance;
    if($balance < $request->input('value')){
      abort(401, 'No sei que msg ou nr meter... :/');
    }
    
    $bid = new Bid;
    $bid->value = $request->input('value');
    $bid->user_id = Auth::user()->id;
    $bid->auction_id = $auction->id;
    $bid->save();
    
    

    $transaction = new Transaction;
    $transaction->value = $bid->value;
    $transaction->description = 'New bid of value ' . $bid->value . ' $ on auction ' . $auction->title;
    $transaction->sender_id = Auth::user()->id;
    $transaction->receiver_id = $auction->user_id;
    $transaction->is_reserved = true;
    $transaction->auction =$id;
    $transaction->save();

    //TODO REMOVE LINE AFTER TRIIGERS ON TRANSACTIONS WORK
    Auth::user()->balance = $balance - $bid->value;
    Auth::user()->save();

    return redirect()->route('auction', ['id' => $id]);
  }
}
