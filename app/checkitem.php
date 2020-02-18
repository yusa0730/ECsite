<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkitem extends Model
{
    protected $fillable = ['user_id', 'item_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function item()
    {
        return $this->belongsTo('\App\Item');
    }

    public function buyitem()
    {
        return $this->belongsTo('\App\User');
    }
}
