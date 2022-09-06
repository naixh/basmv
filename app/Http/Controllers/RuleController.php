<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rule;

class RuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Rule::all();
        return view('admin.rules', compact('data'));
    }

    public function create()
    {
        $validated = request()->validate([
            'Name'          => 'required|string',
            'Description'   => 'required|string',
            'Writer'        => 'required|string',
            'WrittenDate'   => 'required|date_format:Y-m-d',
            'Citation'      => 'required|string',
        ]);
        $status = Rule::create([
            'name'          => $validated['Name'],
            'description'   => $validated['Description'],
            'writer'        => $validated['Writer'],
            'written_date'  => $validated['WrittenDate'],
            'citation'      => $validated['Citation'],
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'Rule Created Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Rule Creation Failed']);
    }

    public function update(Request $request)
    {
        $validated = request()->validate([
            'id'            => 'required|integer',
            'Name'          => 'required|string',
            'Description'   => 'required|string',
            'Writer'        => 'required|string',
            'WrittenDate'   => 'required|date_format:Y-m-d',
            'Citation'      => 'required|string',
        ]);
        $data = Rule::find($validated['id']);
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'Rule Not Found']);
        }
        $status = $data->update([
            'name'          => $validated['Name'],
            'description'   => $validated['Description'],
            'writer'        => $validated['Writer'],
            'written_date'  => $validated['WrittenDate'],
            'citation'      => $validated['Citation'],
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'Rule Updated Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Rule Update Failed']);
    }

    public function delete(Request $request)
    {
        $validated = request()->validate([
            'id'            => 'required|integer',
        ]);
        $data = Rule::find($validated['id']);
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'Rule Not Found']);
        }
        $status = $data->delete();
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'Rule Deleted Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'Rule Deletion Failed']);
    }

}
