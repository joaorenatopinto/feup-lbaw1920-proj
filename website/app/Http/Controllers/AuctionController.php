<?php

namespace App\Http\Controllers;

use App\Auction;
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
  public function showcreateForm($id)
  {
    $auction = Auction::find($id);
    return view('pages.create_auction', ['auction' => $auction]);
  }

  public function create(Request $request)
  {
    $this->validate($request, [
      'title' => 'required',
      'description' => 'required',
      'startDate' => 'required',
      'closeDate' => 'required',
      'initialValue' => 'required',
      'category_id' => 'required',
      'user_id' => 'required',
    ]);


    $auction = Auction::create([
      'title' => $request['title'],
      'description' => $request['description'],
      'startDate' => $request['startDate'],
      'closeDate' => $request['closeDate'],
      'initialValue' => $request['initialValue'],
      'category_id' => $request['category_id'],
      'user_id' => $request['user_id'],
    ]);

    return redirect()->route('auction', [$auction]);
  }

  public function showEditForm($id)
  {
    $auction = Auction::find($id);
    return view('pages.edit_auction', ['auction' => $auction]);
  }

  public function edit(Request $request, $id)
  {
    $auction = Auction::find($id);
    $this->authorize('edit', $request);

    $this->validate($request, [
      'title' => 'required',
      'description' => 'required',
    ]);

    $auction->title = $request->title;
    $auction->description = $request->description;

    return back();
  }
}
