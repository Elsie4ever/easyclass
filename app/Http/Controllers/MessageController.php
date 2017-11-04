<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\UserCourse;
use App\Lecture;
use App\Topic;
use App\Message;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $courses =  Course::all();
        $user_courses=UserCourse::all();
        $lectures=Lecture::all();
        $topics=Topic::all();
        $understands=Understand::all();
        return view('/home',compact('courses','user_courses','lectures','topics','understands'));
    }
    public function create(){
        return view('addClass');
    }
    public function store(Request $request){
            $select = $request->all();
            $coursename=$request->class;
            $courseid = Course::where('coursename',$coursename)->first()->id;
            $select['content']=$request->msgcontent;
            $userid=Auth::user()->id;
            Message::create(['user_id'=>$userid,'content'=>$select['content'],'course_id'=>$courseid]);
            return redirect('/home');

    }
    public function sendMessage(Request $request){
        $course_id=$request['courseId'];
        $content=$request['content'];
        $update = false;
        $message = new Message();
        $message->userid=Auth::user()->id;
        $message->courseid=$course_id;
        $message->content=$content;
        $message->save();
        return null;
    }
}
