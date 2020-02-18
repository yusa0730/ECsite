<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\checkitem;
use App\Item;
use App\Favorite;
use Auth;

class FavoritesController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $favoriteItems = Favorite::select('items.*')
        ->where('user_id', Auth::id())
        ->join('items', 'items.id', '=', 'favorites.item_id')
        ->get();

        return view('favorites/index', ['favoriteItems' => $favoriteItems,'user' => $user]);
    }

    public function store(Request $request, $id)
    {
        \Auth::user()->favorite($id);
        return back();
    }

    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        return back();
    }
}
