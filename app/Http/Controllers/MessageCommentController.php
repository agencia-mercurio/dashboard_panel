<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageComment;
use Illuminate\Support\Facades\Auth;

class MessageCommentController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->all();
        
        $comment = MessageComment::create([
            "message_id"    => $data['message_id'],
            "user_id"          => Auth::user()->id,
            "comment"       => $data['comment']
        ]);

        $comment['user']['name'] = Auth::user()->name;

        return response()->json($comment);
    }
    public function update(int $id, Request $request)

    {
        $data = $request->all();

        $comment = MessageComment::find($id);

        
         $comment->user_id  = Auth::user()->id;
         $comment->comment  = $data['comment'];

         $comment->save();

        $comment['user']['name'] = Auth::user()->name;

        return response()->json($comment);
    }
    public function delete(int $id) {
        return MessageComment::destroy($id);
    }
}