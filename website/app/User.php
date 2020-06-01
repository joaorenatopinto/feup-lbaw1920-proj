<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;


    public function getImage(){
        $image = Image::where('user_id', $this->id)->first();
        return $image;
      }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'name', 'email', 'nif'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function auctions() {
        return $this->hasMany('App\Auction');
    }
    
    public function transactions()
    {
        $transactions = Transaction::where('sender_id', $this->id)->orWhere('receiver_id', $this->id)->get()->reverse();
        return $transactions;
    }
}
