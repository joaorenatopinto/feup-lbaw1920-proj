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
use Illuminate\Pagination\LengthAwarePaginator;
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
      'closeDate' => 'bail|required|date_format:Y-m-d|after:' . now()->modify('-1 day')->format('Y-m-d'),
      'image' => 'bail|required|dimensions:ratio=16/9',
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
      $transaction = Transaction::where('auction',$auction->id)->where('value', $bid->value)->first();
      $transaction->is_reserved = false;
      $transaction->description = 'Value of ' . $auction->title;
      $transaction->save();
      
      $owner = User::find($auction->user_id);
      $owner->balance = $owner->balance + $bid->value;
      $owner->save();
    }
  }


  public function bid(Request $request, $id)
  {
    $auction = Auction::find($id);
   
    if($auction->getLastStatus()->status == 'closed'){
      throw new AuthorizationException("Auction closed! Can't bid", 1);
      return;
    }
    if($auction->getLastStatus()->status == 'removed'){
      throw new AuthorizationException("Auction Removed! Can't bid", 1);
      return;
    }
    if($auction->shouldClose()){
      $this->close($id);
      throw new AuthorizationException("Auction closed! Can't bid", 1);
      return;
    }
    $this->authorize('bid', $auction);
    $max = $auction->getHighestBid();

    /* increment of 1 */
    $min_bid = $max + 1;
    $oldbid = $auction->getWinner();
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

    //TODO REMOVE LINE AFTER TRIGERS ON TRANSACTIONS WORK
    
    if($oldbid != null){
      $oldBidder = User::find($oldbid->user_id);
      $oldBidder->balance = $oldBidder->balance + $oldbid->value;
      $oldBidder->save();
      Transaction::where('value',$oldbid->value)->where('sender_id', $oldBidder->id)->delete();
    }
    

    Auth::user()->balance = $balance - $bid->value;
    Auth::user()->save();

    return redirect()->route('auction', ['id' => $id]);
  }

  public function searchPage(Request $request)
  {
    $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~', '\'', '|', '&'];
    $term= str_replace($reservedSymbols, '',$request['search']);

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

    return view('pages.search', ['auctions' => $pagination]);
  }
}
