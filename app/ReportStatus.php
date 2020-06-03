<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportStatus extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'reportstatus';
    
    public function moderator() {
        return $this->belongsTo('App\User');
    }

    public function admin() {
        return $this->belongsTo('App\Admin');
    }
}
