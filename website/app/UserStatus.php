<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'userstatus';  

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function admin() {
    return $this->belongsTo('App\Admin');
  }

  public function moderator() {
    return $this->belongsTo('App\User');
  }
}
