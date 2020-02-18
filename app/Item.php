<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Favorite;

class Item extends Model
{

    // protected $fillable = ['stock'];

    public function checkitem()
    {
        return $this->hasMany('\App\Checkitem');
    }

    public function favorite_users() {
        $this->belongsToMany(User::class, 'favorites', 'item_id', 'user_id')->withTimestamps();
    }

    public function favorite_by()
    {
      return Favorite::where('user_id', Auth::user()->id)->first();
    }

    // public function stockcount()
    // {
    //     $newstock = $this->stock
    // }
}
