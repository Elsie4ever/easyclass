<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function create(){
        return view('addClass');
    }
    public function store(Request $request){
           return $request->all();
    }
}
