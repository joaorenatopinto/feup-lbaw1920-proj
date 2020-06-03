<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'report';  
    
    public function status() {
        return $this->hasMany('App\ReportStatus');
    }

    public function getLastStatus() {
        return $this->status->sortByDesc('datechanged')->first();
    }

    public function auction() {
        return $this->belongsTo('App\Auction');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
