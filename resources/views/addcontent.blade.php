<?php
use App\Course;
use App\Lecture;
?>
@extends('layouts.app')
<title>easyClass</title>
<link href="css/addcontent.css" rel="stylesheet">
@section('content')
<div class="container">
    <ul class="tabs" role="tablist">
        <label for="tab1"
               role="tab"
               aria-selected="true"
               aria-controls="panel1"
               tabindex="0">Add Content</label>
            <input type="radio" name="tabs" id="tab1" checked />
            <div id="tab-content1"
                 class="tab-content"
                 role="tabpanel"
                 aria-labelledby="description"
                 aria-hidden="false">
                <div class="col-lg-12 addcontent">
                    <p>Create</p>
                </div>
                <!--type-->
                <!--need change-->
                <form class="col-lg-12 col-md-12" method="post" action="/addcontent" novalidate>
                    {{csrf_field()}}
                    <div for="position" class="control-label text-label">Type</div>
                    <select onchange="showMe(this);" type="text" class="form-control dropdown_select" name="content_type" required>
                        <option>Lecture</option>
                        <option>Topic</option>
                    </select>
                    <div for="position" class="control-label text-label" id="underclass1">Class</div>
                    <select type="text" name="underClass" class="form-control" id="underclass2" required>
                        @foreach($user_courses as $user_course)
                        @if($user_course->user_id==Auth::user()->id)
                          @if(Course::where('id',$user_course->course_id)->first()!=null)
                          <option>{{Course::where('id',$user_course->course_id)->first()->coursename}}</option>
                          @endif
                        @endif
                        @endforeach
                    </select>
                    <div for="position" class="control-label text-label" id="underlecture1">Lecture</div>
                    <select type="text" name="underLecture" class="form-control" id="underlecture2" required>
                        @foreach($lectures as $lecture)
                        <option>{{$lecture->lecturename}}</option>
                        @endforeach
                    </select>
                    <div class="control-label text-label" id="lecturename1">Lecture Name</div>
                    <input id="lecturename2" type="text" class="form-control" name="lectureName">
                    <div class="control-label text-label" id="topicname1">Topic Name</div>
                    <input id="topicname2" type="text" class="form-control" name="topicName">
                    <div style="text-align: center">
                        <input class="submitBtn" type="submit" name="submit">
                    </div>
                </form>
            </div>
        </li>
    </ul>
</div>
@endsection
@section('script')
<script>
    function showMe(e) {
        var strdisplay = e.options[e.selectedIndex].value;
        var e = document.getElementById("lecturename1");
        var e1 = document.getElementById("lecturename2");
        var e2 = document.getElementById("underlecture1");
        var e3 = document.getElementById("underlecture2");
        var e4 = document.getElementById("underclass1");
        var e5 = document.getElementById("underclass2");
        var e6 = document.getElementById("topicname1");
        var e7 = document.getElementById("topicname2");
        if(strdisplay == "Topic") {
            e.style.display = "none";
            e1.style.display = "none";
            e2.style.display = "block";
            e3.style.display = "block";
            e4.style.display = "none";
            e5.style.display = "none";
            e6.style.display = "block";
            e7.style.display = "block";
        } else {
            e.style.display = "block";
            e1.style.display = "block";
            e2.style.display = "none";
            e3.style.display = "none";
            e4.style.display = "block";
            e5.style.display = "block";
            e6.style.display = "none";
            e7.style.display = "none";
        }
    }
</script>
@endsection
