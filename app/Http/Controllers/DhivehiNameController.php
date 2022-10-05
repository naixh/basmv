<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DhivehiName;

class DhivehiNameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DhivehiName::all();
        return view('admin.dhivehiNames', compact('data'));
    }

    public function create()
    {
        $validated = request()->validate([
            'Name'          => 'required|string',
            'Thumbnail'     => 'required|Image',
            'Image'         => 'required|Image',
        ]);
        $thumbPath = Helpers::uploadImage($validated['Thumbnail'], "images/");
        $imagePath = Helpers::uploadImage($validated['Image'], "images/");
        $status = DhivehiName::create([
            'name'          => $validated['Name'],
            'thumbnail'     => $thumbPath,
            'image'         => $imagePath,
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'Name Created Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Name Creation Failed']);
    }

    public function update(Request $request)
    {
        $validated = request()->validate([
            'id'            => 'required|integer',
            'Name'          => 'required|string',
            'Thumbnail'       => 'nullable|Image',
            'Image'         => 'nullable|Image',
        ]);
        $data = DhivehiName::find($validated['id']);
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'Name Not Found']);
        }
        $thumbPath = $data->thumbnail;
        if(isset($validated['Thumbnail']) && $validated['Thumbnail']){
            $thumbPath = Helpers::uploadImage($validated['Image'], "images/");
        }
        $imagePath = $data->image;
        if(isset($validated['Image']) && $validated['Image']){
            $imagePath = Helpers::uploadImage($validated['Image'], "images/");
        }
        $status = $data->update([
            'name'          => $validated['Name'],
            'thumbnail'     => $thumbPath,
            'image'         => $imagePath,
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'Name Updated Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Name Update Failed']);
    }

    public function delete(Request $request)
    {
        $validated = request()->validate([
            'id'            => 'required|integer',
        ]);
        $data = DhivehiName::find($validated['id']);
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'Name Not Found']);
        }
        if($data->delete()){
            return response()->json(['Status'=>'success', 'Message'=>'Name Deleted Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Name Deletion Failed']);
    }

}
