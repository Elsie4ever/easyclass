<?php

namespace App\Http\Controllers;
use App\Course;
use App\User;
use App\UserCourse;
use App\Lecture;
use App\Topic;
use Auth;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(){
        $courses =  Course::all();
        $user_courses=UserCourse::all();
        $lectures=Lecture::all();
        $topics=Topic::all();
        return view('/home',compact('courses','user_courses','lectures','topics'));
    }
    public function create(){
        return view('addClass');
    }
    public function addclass(){
        $courses =  Course::all();
        $user_courses=UserCourse::all();
        return view('/addclass',compact('courses'),compact('user_courses'));
    }
    public function addcontent(){
        $courses =  Course::all();
        $user_courses=UserCourse::all();
        return view('/addcontent',compact('courses'),compact('user_courses'));
    }
    public function store(Request $request){
        if(Auth::user()->position=="Instructor"){
            $input = $request->all();
            $input['coursename']=$request->coursename;
            $course=Course::create($request->all());
            $userid=Auth::user()->id;
            $courseid=$course->id;
            UserCourse::create(['user_id'=>$userid,'course_id'=>$courseid]);
            return redirect('/home');
        }
        else{
            $select = $request->all();
            $select['coursenameStudent']=$request->coursenameStudent;
            $userid=Auth::user()->id;
            $courseid=Course::where('coursename',$request->coursenameStudent)->first()->id;
            UserCourse::create(['user_id'=>$userid,'course_id'=>$courseid]);
            return redirect('/home');
        }
    }
}
