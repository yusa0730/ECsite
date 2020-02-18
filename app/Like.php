<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Like extends Model
{
    protected $fillable = ['user_id', 'item_id'];

    public function users()
    {
        return $this->belongsTo('\App\User');
    }

    public function items()
    {
        return $this->belongsTo('\App\Item');
    }
}
