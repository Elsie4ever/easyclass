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
        <li>
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
                <div class="col-md-10 col-md-push-2 form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                    <div for="position" class="col-md-2 control-label">Type</div>
                    <div class="col-md-8">
                        <select onchange="showMe(this);" id="content_type" type="text" class="form-control" name="content_type" value="{{ old('position') }}" required>
                            <option>Lecture</option>
                            <option>Topic</option>
                        </select>
                        @if ($errors->has('position'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <!--for topic-->
                <!--need change-->
                <div class="col-md-10 col-md-push-2 form-group{{ $errors->has('position') ? ' has-error' : '' }}" id="underlecture">
                    <div for="position" class="col-md-2 control-label">Lecture</div>
                    <div class="col-md-8">
                        <select id="content_type" type="text" class="form-control" name="content_type" value="{{ old('position') }}">
                            <option>Data</option>
                            <option>Signal</option>
                        </select>
                        @if ($errors->has('position'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <!--topic name-->
                <!--need change-->
                <div class="col-md-10 col-md-push-2  form-group{{ $errors->has('lastname') ? ' has-error' : '' }}" id="topicName">
                    <div for="name" class="col-md-2 control-label">Topic Name</div>

                    <div class="col-md-8">
                        <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>

                        @if ($errors->has('lastname'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <img  src="/img/add.png" style="height: 30px"/>
                    </div>
                </div>
                <!--lecture name-->
                <!--need change-->
                <div class="col-md-10 col-md-offset-2  form-group{{ $errors->has('lecturename') ? ' has-error' : '' }}" id="lectureName">
                    <div for="lecturename" class="col-md-2 control-label">Lecture Name</div>

                    <div class="col-md-8">
                        <input id="lecturename" type="text" class="form-control" name="lecturename" value="{{ old('lecturename') }}">

                        @if ($errors->has('lecturename'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('lecturename') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12" style="text-align: center;margin:50px 20px;">
                    <a class="submit_add" href="{{ url('/home') }}" type="submit">
                        Submit
                    </a>
                </div>
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
