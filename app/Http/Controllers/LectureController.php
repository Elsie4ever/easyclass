<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Lecture;
use App\Topic;
use App\User;
use App\UserCourse;
use Auth;
class LectureController extends Controller
{
    public function index(){
        $courses =  Course::all();
        $user_courses=UserCourse::all();
        $lectures=Lecture::all();
        return view('/addcontent',compact('courses'),compact('user_courses'),compact('lectures'));
    }
    public function create(){
        return view('addcontent');
    }

    public function store(Request $request){
            $select = $request->all();
            $select['content_type']=$request->content_type;
            if($select['content_type'] == "Lecture"){
                $classname = $request->underClass;
                $classid = Course::where('coursename',$classname)->first()->id;
                $lecturename = $request->lectureName;
                Lecture::create(['lecturename'=>$lecturename,'course_id'=>$classid]);
                return redirect('/home');
            }
            else{
                $lectureid = Course::where('lecturename',$request->underlecture)->first()->id;
                $topicname = $request->topicName;
                Topic::create(['topicname'=>$topicname,'lecture_id'=>$lectureid]);
                return redirect('/home');
            }
    }
}
