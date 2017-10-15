<?php

namespace App\Http\Controllers;
use App\Course;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(){
        $courses =  Course::all();
        return view('/home',compact('courses'));
    }
    public function create(){
        return view('addClass');
    }
    public function store(Request $request){
        $input = $request->all();
        $input['coursename']=$request->coursename;
        Course::create($request->all());
        return redirect('/home');
    }
}
