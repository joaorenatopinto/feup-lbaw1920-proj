<?php

namespace App;

use Illuminate\Contracts\Console\Application;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'category';

}
