<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'userstatus';  
}
