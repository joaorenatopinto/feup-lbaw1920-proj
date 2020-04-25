<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
  public function show($id)
  {
    $auction = Auction::find($id);
    return view('pages.auction', ['auction' => $auction]);
  }
  public function showCreateForm()
  {
    $this->authorize('create');
    return view('pages.create_auction');
  }

  public function create(Request $request)
  {
    $this->authorize('create');

    $this->validate($request, [
      'title' => 'required',
      'description' => 'required',
      'closeDate' => 'required',
      'initialValue' => 'required',
      'category' => 'required',
    ]);

    $category_id = Category::where('name',$request['category'])->first();

    /**
      * TODO adicionar user; authenticate se o user esta logged in
      */

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
    $this->validate($request, [
      'title' => 'required',
      'description' => 'required',
    ]);

    $auction->title = $request->title;
    $auction->description = $request->description;

    return back();
  }
}
