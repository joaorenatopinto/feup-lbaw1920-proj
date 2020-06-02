<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportStatus extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'reportstatus';  
}
