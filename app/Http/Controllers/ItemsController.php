<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;


class ItemsController extends Controller
{
    // public function show($id){
    //     $user = \Auth::user();
    //     return view('users.show', ['user' => $user]);
    // }
    public function index(Request $request)
    {
        $user = \Auth::user();
        if ($request->has('keyword')) {
            $items = Item::where('name', 'like', '%'.$request->get('keyword').'%')->paginate(15);
        }else{
            $items = Item::paginate(15);
        }
        return view('item/index', ['items' => $items, 'user' => $user]);
    }

    public function show(Item $item)
    {
        $user = \Auth::user();
        return view('item/show', ['item' => $item, 'user'=>$user]);
    }
}
