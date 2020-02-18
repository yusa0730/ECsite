<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessagesController extends Controller
{
    public function index(){
        $messages = Message::all();
        $user = \Auth::user();
        return view('messages.index', compact("user", "messages"));
    }

    public function store(Request $request){
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->messages()->create([
            'content' => $request->content,
        ]);

        return back();
    }

    public function destroy($id)
    {
        $message = Message::find($id);

         if (\Auth::id() === $message->user_id) {
            $message->delete();
         }

         return back()->with('flash_message','口コミを削除しました');
    }
}
