<?php

namespace App\Http\Controllers;

use App\Understand;
use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\UserCourse;
use App\Lecture;
use App\Topic;
use Auth;
class TopicController extends Controller
{
    public function topicLikeTopic(Request $request){
        $topic_id=$request['topicId'];
        $liked=$request['likedd']==='true'?true:false;
        $update = false;
        $topic = Topic::find($topic_id);
        if(!$topic){
            return null;
        }
        $user = Auth::user();
        $dontUnderstand = $user->understands()->where('topic_id',$topic_id)->first();
        if($dontUnderstand){
            $already_dontUnderstand = $dontUnderstand->understand;
            $update = true;
            if($already_dontUnderstand == $liked){
                $dontUnderstand->delete();
                return null;
            }
        }else{
            $dontUnderstand = new Understand();
        }
        $dontUnderstand->understand = $liked;
        $dontUnderstand->user_id=$user->id;
        $dontUnderstand->topic_id=$topic->id;
        if($update){
            $dontUnderstand->update();
        }else{
            $dontUnderstand->save();
        }
        return null;
    }
}
