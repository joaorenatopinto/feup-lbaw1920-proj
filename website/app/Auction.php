<?php

namespace App;

use Illuminate\Contracts\Console\Application;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'auction';

  /**
   * The user this card belongs to
   */
  public function user() {
    return $this->belongsTo('App\User');
  }

  public function getImage(){
    $image = Image::where('auction_id', $this->id)->first();
    return $image;
  }

  public function getDescription(){
    $description = Description::where('auction_id', $this->id)->first();
    return $image;
  }

  public function getHighestBid(){
    $price = Bid::where('auction_id', $this->id)->max('value');
    return  $price;
  }
}
