<?php

namespace App\Http\Controllers;

use App\checkitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Mail\Buy;
use Illuminate\Support\Facades\Mail;

class BuyController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $checkitems = checkitem::select('checkitems.*', 'items.name', 'items.price')
            ->where('user_id', Auth::id())
            ->join('items', 'items.id', '=', 'checkitems.item_id')
            ->get();
        $subtotal = 0;
        foreach ($checkitems as $checkitem){
            $subtotal += $checkitem->price * $checkitem->quantity;
        }
        return view('buy/index', ['checkitems' => $checkitems, 'subtotal' => $subtotal,'user' => $user]);
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        if ($request->has('post')) {
            Mail::to(Auth::user()->email)->send(new Buy());
            checkitem::where('user_id', Auth::id())->delete();
            return view('buy/complete',['user' => $user]);
        }
        $request->flash();
        return $this->index();
    }
}
