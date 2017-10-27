<?php
use App\Course;
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
                <form method="post" action="/addcontent">
                    {{csrf_field()}}
                    <div for="position" class="col-md-2 control-label">Type</div>
                    <select class="col-md-10" onchange="showMe(this);" type="text" class="form-control" name="content_type" required>
                        <option>Lecture</option>
                        <option>Topic</option>
                    </select>
                    <div for="position" class="col-md-2 control-label">Class</div>
                    <select class="col-md-10" onchange="showMe(this);" type="text" name="underClass" required>
                        @foreach($user_courses as $user_course)
                        @if($user_course->user_id==Auth::user()->id)
                        <option>{{Course::where('id',$user_course->course_id)->first()->coursename}}</option>
                        @endif
                        @endforeach
                    </select>
                    <div class="col-md-2 control-label">Lecture Name</div>
                    <input class="col-md-10" type="text" class="form-control" name="lectureName">
                    <input class="col-lg-12" type="submit" name="submit">
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
        var e = document.getElementById("underlecture");
        var e2 = document.getElementById("topicName");
        var e3 = document.getElementById("lectureName");
        if(strdisplay == "Topic") {
            e.style.display = "block";
            e2.style.display = "block";
            e3.style.display = "none";
        } else {
            e.style.display = "none";
            e2.style.display = "none";
            e3.style.display = "block";
        }
    }
</script>
@endsection
