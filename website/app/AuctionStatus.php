<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionStatus extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'auctionstatus';

  public function auction() {
    return $this->belongsTo('App\Auction');
  }

  public function admin() {
    return $this->belongsTo('App\Admin');
  }

  public function moderator() {
    return $this->belongsTo('App\User');
  }
}
