<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $validated = request()->validate([
            'Discussion'   => 'required|integer',
            'Comment'      => 'required|string',
        ]);
        $check = Discussion::find($validated['Discussion']);
        if(! $check){
            return response()->json(['Status'=>'error', 'Message'=>'Discussion Not Found']);
        }
        $status = Comment::create([
            'discussion_id' => $validated['Discussion'],
            'comment'       => $validated['Comment'],
            'user_id'       => auth()->id(),
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'Comment Created Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Comment Creation Failed']);
    }

    public function delete(Request $request)
    {
        $validated = request()->validate([
            'id'            => 'required|integer',
        ]);
        $data = Comment::owned()->whereId($validated['id'])->first();
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'Comment Not Found']);
        }
        if($data->delete()){
            return response()->json(['Status'=>'success', 'Message'=>'Comment Deleted Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Comment Deletion Failed']);
    }

}
