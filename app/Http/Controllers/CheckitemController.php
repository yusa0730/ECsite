<?php

namespace App\Http\Controllers;

use App\Cart_item;
use App\Item;
use App\checkitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckitemController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $checkitems = checkitem::select('checkitems.*', 'items.name', 'items.price')
            ->where('user_id', Auth::id())
            ->join('items', 'items.id', '=', 'checkitems.item_id')
            ->get();
        $subtotal = 0;
        foreach($checkitems as $checkitem){
            $subtotal += $checkitem->price * $checkitem->quantity;
        }
        return view('checkitem/index', ['checkitems' => $checkitems, 'subtotal' => $subtotal, 'user' => $user]);
    }


    public function store(Request $request)
    {
        // $cart_item = new Cart_item;
        checkitem::updateOrCreate(
            [
                // 'cart_item_id' => $cart_item->id,
                // 'cart_item_id' => $request->post('cart_item_id'),
                'user_id' => Auth::id(),
                'item_id' => $request->post('item_id'),
            ],
            [
                'quantity' => \DB::raw('quantity + ' . $request->post('quantity') ),
            ]
        );
        $item = Item::find($request->item_id);
        $newstock = $item->stock - $request->quantity;
        $item->stock = $newstock;
        if ($item->stock <= 0) {
            $item->stock = 0;
        }
        $item->save();
        return redirect('/')->with('flash_message', 'カートに追加しました');
    }

    public function update(Request $request, $id)
    {

        $item = Item::find($request->item_id);
        $checkitem = checkitem::find($id);
        $checkitem->quantity = $request->post('quantity');
        $checkitem->item->stock = $checkitem->item->stock - $request->quantity;
        $item->stock = $checkitem->item->stock;
        if ($item->stock <= 0) {
            $item->stock = 0;
        }
        $checkitem->save();
        $item->save();
        return redirect('/checkitem')->with('flash_message', 'カートを更新しました');
    }

    public function destroy($id){
        $checkitem = checkitem::find($id);
        if (\Auth::id() === $checkitem -> user_id) {
            $checkitem->delete();
        }
        return back()->with('flash_message','カートから削除しました');
    }
}
