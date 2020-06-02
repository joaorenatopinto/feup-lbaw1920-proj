<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'bid';

  protected $fillable = [
    'value', 'user_id', 'auction_id'
  ];

  /**
   * The user this card belongs to
   */
  public function auction() {
    return $this->hasOne('App\Auction');
  }
}
