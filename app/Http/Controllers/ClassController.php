<?php

namespace App\Http\Controllers;
use App\Course;
use App\User;
use App\UserCourse;
use App\Lecture;
use App\Topic;
use App\Understand;
use App\Message;
use Auth;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(){
        $courses =  Course::all();
        $user_courses=UserCourse::all();
        $lectures=Lecture::all();
        $topics=Topic::all();
        $users=Auth::user();
        foreach($user_courses as $user_course){
            if($user_course->user_id == $users->id){
                $currentcourse_id=$users->courses()->first()->course_id;
                $currentcourse=$courses->where('id',$currentcourse_id)->first()->coursename;
            }
            else{
                $currentcourse_id=-1;
                $currentcourse='';
            }
        }
            //$currentcourse_id=$users->courses()->first()->course_id;
        //$currentcourse=$courses->where('id',$currentcourse_id)->first()->coursename;
        $understands=Understand::all();
        $messages=Message::all();
        return view('/home',compact('courses','currentcourse','$currentcourse_id','user_courses','lectures','topics','understands','messages'));
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
    public function sendMessage(Request $request){
        $send = new Message();
        $send->course_id = Course::where('coursename',$request->courseId)->first()->id;
        $send->content = $request->contentmsg;
        $send->user_id = Auth::user()->id;
//        $select = $request->all();
//        $coursename=$request->class;
//        $courseid = Course::where('coursename',$coursename)->first()->id;
//        $select['content']=$request->msgcontent;
//        $userid=Auth::user()->id;
        try{
            $send->save();
        }
        catch(\Exception $e){
            // do task when error
            echo $e->getMessage();   // insert query
        }
        $send->save();
        return response()->json($send);
    }
    public function getMessage(){
        $message = Message::all();
        return response()->json($message);
    }
    public function switchclass(Request $request){
        $classroom = $request->switch_class;
        $courseid = Course::where('coursename',$classroom)->first()->id;
        $courses =  Course::all();
        $currentcourse = Course::where('coursename',$classroom)->first()->coursename;
        $currentcourse_id = Course::where('coursename',$classroom)->first()->id;
        $user_courses=UserCourse::all();
        $lectures=Lecture::all();
        $topics=Topic::all();
        $understands=Understand::all();
        $messages = Message::where('course_id',$courseid)->get();
        return view('/home',compact('courses','currentcourse','$currentcourse_id','user_courses','lectures','topics','understands','messages'));
    }

}
