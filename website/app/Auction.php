<?php

namespace App;

use Illuminate\Contracts\Console\Application;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'auction';

  protected $fillable = ['user_id', 'title', 'category_id', 'description', 'startDate', 'closeDate', 'initialValue'];

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
    $auction = Auction::where('id', $this->id);
    $max = Bid::where('auction_id', $this-> id)->max('value');
    if($max == null) return $auction->initialValue;
    else return $max;
  }

  public function getCategory()
    {
        return $this->belongsTo('App\Category');
    }

  public function scopeSearch($query, $search)
  {
    $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
    $search = str_replace($reservedSymbols, '', $search);
    if (!$search)
      return $query;
    $search = "%{$search}%";
    return $query->orWhereRaw("CONCAT(title, ' ', description) LIKE ?", [$search]);
  }
}
