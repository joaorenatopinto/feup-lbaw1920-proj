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
        $transactions = Transaction::where('sender_id', $this->id)->orWhere('receiver_id', $this->id)->orderBy('date','desc')->paginate(10);
        return $transactions;
    }

    public function notifications()
    {
        $notifications = Notification::where('user_id', $this->id)->orderBy('date','desc')->paginate(10);
        return $notifications;
    }

    public function status() {
        return $this->hasMany('App\UserStatus');
    }

    public function getLastStatus() {
        return $this->status->sortByDesc('datechanged')->first();
    }

    public function scopeSearch($query, $search) {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $search = str_replace($reservedSymbols, '', $search);
        if (!$search)
          return $query;
        $search = strtoupper($search);
        $search = "%{$search}%";
        return $query->orWhereRaw("CONCAT(upper(name), ' ', upper(username), ' ', upper(email)) LIKE ?", [$search]);
    }
}
