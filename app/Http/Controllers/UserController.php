<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $data = User::all();
        return view('admin.users', compact('data'));
    }

    public function create(){
        $validated = request()->validate([
            'Name'          => 'required|string',
            'Email'         => 'required|email',
            'Image'         => 'required|image',
            'UserType'      => 'required|string',
            'Password'      => 'required|string',
        ]);
        $imagePath = Helpers::uploadImage($validated['Image'], "images/");
        $status = User::create([
            'name'          => $validated['Name'],
            'email'         => $validated['Email'],
            'image'         => $imagePath,
            'user_type'     => $validated['UserType'],
            'password'      => bcrypt($validated['Password']),
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'User Created Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'User Creation Failed']);
    }

    public function update(Request $request){
        $validated = request()->validate([
            'id'            => 'required|integer',
            'Name'          => 'required|string',
            'Email'         => 'required|email',
            'Image'         => 'nullable|image',
            'UserType'      => 'required|string',
            'Password'      => 'nullable|string',
        ]);
        $data = User::find($validated['id']);
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'User Not Found']);
        }
        $imagePath = $data->image;
        if(isset($validated['Image']) && $validated['Image']){
            $imagePath = Helpers::uploadImage($validated['Image'], "images/");
        }
        $password = @$validated['Password'] ? bcrypt($validated['Password']) : $data->password;
        $status = $data->update([
            'name'          => $validated['Name'],
            'email'         => $validated['Email'],
            'image'         => $imagePath,
            'user_type'     => $validated['UserType'],
            'password'      => $password,
        ]);
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'User Updated Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'User Update Failed']);
    }

    public function delete(Request $request){
        $validated = request()->validate([
            'id'            => 'required|integer',
        ]);
        $data = User::find($validated['id']);
        if(! $data){
            return response()->json(['Status'=>'error', 'Message'=>'User Not Found']);
        }
        $status = $data->delete();
        if($status){
            return response()->json(['Status'=>'success', 'Message'=>'User Deleted Successfully']);
        }
        return response()->json(['Status'=>'error', 'Message'=>'User Deletion Failed']);
    }

}
