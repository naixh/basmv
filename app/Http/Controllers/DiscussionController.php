<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discussion;

class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Discussion::with('comments','lastComment')->get();
        return view('admin.discussion', compact('data'));
    }

    public function find()
    {
        $validated = request()->validate([
            'id'            => 'required|integer',
        ]);
        $data = Discussion::with('comments','lastComment')->whereId($validated['id'])->get();
        return response()->json($data);
    }

    public function create()
    {
        $validated = request()->validate([
            'Title'         => 'required|string',
            'Description'   => 'required|string',
        ]);
        $status = Discussion::create([
            'title'         => $validated['Title'],
            'description'   => $validated['Description'],
            'user_id'       => auth()->id(),
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'Discussion Created Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Discussion Creation Failed']);
    }

    public function delete(Request $request)
    {
        $validated = request()->validate([
            'id'            => 'required|integer',
        ]);
        $data = Discussion::owned()->whereId($validated['id'])->first();
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'Discussion Not Found']);
        }
        if($data->delete()){
            return response()->json(['Status'=>'success', 'Message'=>'Discussion Deleted Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Discussion Deletion Failed']);
    }

}
