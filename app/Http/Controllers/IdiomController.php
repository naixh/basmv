<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idiom;

class IdiomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Idiom::all();
        return view('admin.idioms', compact('data'));
    }

    public function create()
    {
        $validated = request()->validate([
            'Name'          => 'required|string',
            'Meaning'       => 'required|string',
        ]);
        $status = Idiom::create([
            'name'          => $validated['Name'],
            'meaning'   => $validated['Meaning'],
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'Idiom Created Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Idiom Creation Failed']);
    }

    public function update(Request $request)
    {
        $validated = request()->validate([
            'id'            => 'required|integer',
            'Name'          => 'required|string',
            'Meaning'       => 'required|string',
        ]);
        $data = Idiom::find($validated['id']);
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'Idiom Not Found']);
        }
        $status = $data->update([
            'name'          => $validated['Name'],
            'meaning'   => $validated['Meaning'],
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'Idiom Updated Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Idiom Update Failed']);
    }

    public function delete(Request $request)
    {
        $validated = request()->validate([
            'id'            => 'required|integer',
        ]);
        $data = Idiom::find($validated['id']);
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'Idiom Not Found']);
        }
        if($data->delete()){
            return response()->json(['Status'=>'success', 'Message'=>'Idiom Deleted Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Idiom Deletion Failed']);
    }

}
