<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Image;
use App\Auction;
use App\AuctionStatus;
use App\Category;
use App\Report;
use App\ReportStatus;
use App\Transaction;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
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

    $status = new AuctionStatus();
    $status->datechanged = date("Y-m-d H:i:s");
    $status->auction_id = $auction->id;
    $status->status = 'ongoing';

    $status->save();


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

  public function showReportForm($id)
  {
    $auction = Auction::find($id);
    return view('pages.report_auction', ['auction' => $auction]);
  }

  public function report(Request $request, $id)
  {
    $this->validate($request, [
      'description' => 'bail|required|max:1500',
    ]);

    $report = new Report();
    $report->user_id = Auth::user()->id;
    $report->auction_id = $id;
    $report->description = $request['description'];
    $report->save();
    
    $report_status = new ReportStatus();
    $report_status->datechanged = date("Y-m-d H:i:s");
    $report_status->type = 'notSeen';
    $report_status->report_id = $report->id;
    $report_status->save();

    return redirect()->route('auction', ['id' => $id]);
  }


  public function close($id){
    $auction = Auction::find($id);
    $status = new AuctionStatus();
    $status->datechanged = date("Y-m-d H:i:s");
    $status->auction_id = $auction->id;
    $status->status = 'closed';
    $status->save();

    $bid = $auction->getWinner();
    if($bid != null) {
      $transaction = Transaction::where('auction',$auction->id,'value',$bid->value);
      $transaction->is_reserved = false;
      $transaction->description = 'Winner of ' . $auction->title;

      $owner = User::find($auction->user_id);
      $owner->balance = $owner->balance - $bid->value;
      $owner->save();
    }
  }


  public function bid(Request $request, $id)
  {
    $auction = Auction::find($id);
    if($auction->shouldClose()){
      $this->close($id);
      throw new AuthorizationException("Auction closed! Can't bid", 1);
      return;
    }
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
