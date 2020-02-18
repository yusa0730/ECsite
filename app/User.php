<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Message;
use App\checkitem;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function checkitems()
    {
        return $this->hasMany('\App\checkitem');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function buyitem(){
        return $this->hasMany('\App\checkitem');
    }

    public function favorites(){
        return $this->belongsToMany(Item::class, 'favorites', 'user_id', 'item_id')->withTimestamps();
    }


    public function favorite($itemId){
        $exist = $this->is_favorite($itemId);

        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($itemId);
            return true;
        }
    }

    public function unfavorite($itemId){
        $exist = $this->is_favorite($itemId);

        if ($exist) {
            $this->favorites()->detach($itemId);
            return true;
        }else{
            return false;
        }
    }

    public function is_favorite($itemId){
        return $this->favorites()->where('item_id', $itemId)->exists();
    }
}
