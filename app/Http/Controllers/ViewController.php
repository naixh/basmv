<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Idiom;
// use App\Models\Linguist;
use App\Models\DhivehiName;
use App\Models\History;
use App\Models\User;

class ViewController extends Controller
{
    public function rules(){
        $data = Rule::orderBy('created_at','desc')->get();
        return view('rules', compact('data'));
    }

    public function idioms(){
        $data = Idiom::orderBy('created_at','desc')->get();
        return view('idioms', compact('data'));
    }

    public function linguists(){
        $data = User::where('user_type','linguist')->orderBy('created_at','desc')->get();
        return view('linguists', compact('data'));
    }

    public function dhivehiNames(){
        $data = DhivehiName::orderBy('created_at','desc')->get();
        return view('dhivehiNames', compact('data'));
    }

    public function dhivehiDates(){
        $data = History::orderBy('created_at','desc')->get();
        return view('histories', compact('data'));
    }
}
