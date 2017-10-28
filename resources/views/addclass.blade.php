<?php
use App\Course;
?>
@extends('layouts.app')
<title>easyClass</title>
<link href="/css/addclass.css" rel="stylesheet">
@section('content')
<div class="container">
    @if(Auth::user()->position == "Student")
    <ul class="tabs" role="tablist">
        <li>
            <input type="radio" name="tabs" id="tab1" checked />
            <label for="tab1"
                   role="tab"
                   aria-selected="true"
                   aria-controls="panel1"
                   tabindex="0">Class</label>
            <div id="tab-content1"
                 class="tab-content"
                 role="tabpanel"
                 aria-labelledby="description"
                 aria-hidden="false">
                <div class="col-lg-12 addcontent">
                    <p>Add Class</p>
                </div>
                <!--Class name-->
                <!--need change-->
                <form method="post" action="/home">
                    {{csrf_field()}}
                    <select type="text" class="form-control"  name="coursenameStudent">
                        @foreach($courses as $course)
                        <option>{{Course::where('id',$course->id)->first()->coursename}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="submit">
                </form>
            </div>
        </li>
    </ul>
    <script>
        $(function() {
            // Bind Click event to the drop down navigation button
            $(".nav-button").click(function() {
                /*  Toggle the CSS closed class which reduces the height of the UL thus
                 hiding all LI apart from the first */
                $(this).parent().parent().toggleClass("closed");
            });

        });
    </script>
    @else
    <ul class="tabs" role="tablist">
        <li>
            <input type="radio" name="tabs" id="tab1" checked />
            <label for="tab1"
                   role="tab"
                   aria-selected="true"
                   aria-controls="panel1"
                   tabindex="0">Class</label>
            <div id="tab-content1"
                 class="tab-content"
                 role="tabpanel"
                 aria-labelledby="description"
                 aria-hidden="false">
                <div class="col-lg-12 addcontent">
                    <p>Create</p>
                </div>
                <!--Class name-->
                <!--need change-->
                <form method="post" action="/home">
                    {{csrf_field()}}
                    <input type="text" class="form-control" name="coursename">
                    <div style="text-align: center">
                        <input class="submitBtn" type="submit" name="submit">
                    </div>
                </form>
            </div>
        </li>
    </ul>
    <script>
        $(function() {
            // Bind Click event to the drop down navigation button
            $(".nav-button").click(function() {
                /*  Toggle the CSS closed class which reduces the height of the UL thus
                 hiding all LI apart from the first */
                $(this).parent().parent().toggleClass("closed");
            });

        });
    </script>
    @endif
</div>
@endsection
