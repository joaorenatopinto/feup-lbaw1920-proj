<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $timestamps  = false;

  protected $table = 'transaction';

  protected $fillable = [
      'value', 'description', 'sender_id', 'receiver_id', 'is_reserved','auction'
  ];
}
