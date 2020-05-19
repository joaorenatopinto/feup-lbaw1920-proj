<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'image';

  protected $fillable = [
      'path', 'auction_id', 'user_id'
  ];
}
