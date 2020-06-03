<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'auction';

  protected $fillable = ['user_id', 'title', 'category_id', 'initialvalue', 'description', 'startdate', 'closedate'];

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

  public function getHighestBid(){
    $max = Bid::where('auction_id', $this-> id)->max('value');
    if($max == null) return $this->initialvalue;
    else return $max;
  }

  public function getCategory() {
    return $this->belongsTo('App\Category');
  }

  public function scopeSearch($query, $search) {
    $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
    $search = str_replace($reservedSymbols, '', $search);
    if (!$search)
      return $query;
    $search = strtoupper($search);
    $search = "%{$search}%";
    return $query->orWhereRaw("CONCAT(upper(title), ' ', upper(description)) LIKE ?", [$search]);
  }

  public function category() {
    return $this->belongsTo('App\Category');
  }

  public function status() {
    return $this->hasMany('App\AuctionStatus');
  }

  public function getLastStatus() {
    return $this->status->sortByDesc('datechanged')->first();
  }

  /**
   * Returns a string with the time left for the auction to end
   */
  public function timeLeft() {
    $now = new DateTime();
    $close = new DateTime($this->closedate);

    $dif = $now->diff($close);

    return  $dif->y . 'y ' . $dif->m . 'm ' . $dif->d . 'd ' . $dif->h . 'h ' . $dif->m . 'm';
  }
}
