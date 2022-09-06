<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = History::all();
        return view('admin.histories', compact('data'));
    }

    public function create()
    {
        $validated = request()->validate([
            'Name'          => 'required|string',
            'Description'   => 'required|string',
            'Image'         => 'required|Image',
            'Caption'       => 'required|string',
            'Date'          => 'required|date_format:Y-m-d',
        ]);
        $imagePath = Helpers::uploadImage($validated['Image'], "images/");
        $status = History::create([
            'name'          => $validated['Name'],
            'description'   => $validated['Description'],
            'image'         => $imagePath,
            'caption'       => $validated['Caption'],
            'date'          => $validated['Date'],
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'History Created Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'History Creation Failed']);
    }

    public function update(Request $request)
    {
        $validated = request()->validate([
            'id'            => 'required|integer',
            'Name'          => 'required|string',
            'Description'   => 'required|string',
            'Image'         => 'nullable|Image',
            'Caption'       => 'required|string',
            'Date'          => 'required|date_format:Y-m-d',
        ]);
        $data = History::find($validated['id']);
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'History Not Found']);
        }
        $imagePath = $data->image;
        if(isset($validated['Image']) && $validated['Image']){
            $imagePath = Helpers::uploadImage($validated['Image'], "images/");
        }
        $status = $data->update([
            'name'          => $validated['Name'],
            'description'   => $validated['Description'],
            'image'         => $imagePath,
            'caption'       => $validated['Caption'],
            'date'          => $validated['Date'],
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'History Updated Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'History Update Failed']);
    }

    public function delete(Request $request)
    {
        $validated = request()->validate([
            'id'            => 'required|integer',
        ]);
        $data = History::find($validated['id']);
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'History Not Found']);
        }
        $status = $data->delete();
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'History Deleted Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'History Deletion Failed']);
    }

}
