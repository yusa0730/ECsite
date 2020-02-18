<!-- <?php

// namespace App\Http\Controllers;

// use App\Cart_item;
// use App\checkitem;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class Cart_itemsController extends Controller
// {
//     public function store(Request $request)
//     {
//         // $cart_item = new Cart_item;

//         Cart_item::updateOrCreate(
//             [
//                 // 'cart_item_id' => $cart_item->id,
//                 // 'cart_item_id' => $request->post('cart_item_id'),
//                 'user_id' => Auth::id(),
//                 'item_id' => $request->post('item_id'),
//             ],
//             [
//                 'quantity' => \DB::raw('quantity + ' . $request->post('quantity') ),
//             ]
//         );
//         return redirect('/')->with('flash_message', 'カートに追加しました');
//     }
// }
