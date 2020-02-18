<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\checkitem;
use App\Item;
use Auth;

class UsersController extends Controller
{
    public function show(User $user){
        $checkitems = checkitem::select('checkitems.*', 'items.name', 'items.price')
        ->where('user_id', Auth::id())
        ->join('items', 'items.id', '=', 'checkitems.item_id')
        ->get();

        $subtotal = 0;
        foreach ($checkitems as $checkitem) {
            $subtotal += $checkitem->price * $checkitem->quantity;
        }
        return view('user/show', ['user' => $user, 'checkitems' => $checkitems, 'subtotal' =>$subtotal]);
    }

    // public function favorites(){
    //     $favoriteItems = Item::select('items.*')
    //     ->where('user_id', Auth::id())
    //     ->join('items', 'items.id', '=', 'favorites.item_id')
    //     ->get();

    //     return view('users.favorites', ['favoriteItems' => $favoriteItems]);
    // }
}
