<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
    protected $fillable = ['cart_item_id', 'item_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }


    public function checkitem()
    {
        return $this->hasMany('\App\Checkitem');
    }
}
