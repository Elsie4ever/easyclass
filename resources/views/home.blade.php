<?php
use App\Course;
use App\Lecture;
use App\Topic;
use App\Understand;
use App\Msgunderstd;
?>
@extends('layouts.app')
<title>easyClass</title>
<link href="css/home.css" rel="stylesheet">
@section('content')
<div class="container">
    @if(Auth::user()->position == "Student")
    <ul class="tabs" role="tablist">
        <li>
            <input type="radio" name="tabs" id="tab1" href="#tab1" checked />
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
                <div class="col-lg-12 addBtn">Add Class
                    <a href="{{ url('/addclass') }}"><image src="/img/add.png" style="height: 50px"/></a>
                </div>
                <ul>
                    @foreach($user_courses as $user_course)
                    @if($user_course->user_id==Auth::user()->id)
                    <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-6 courses">Course Name: {{Course::where('id',$user_course->course_id)->first()->coursename}}</div>
                        @foreach($lectures as $lecture)
                        @if($lecture->course_id==$user_course->course_id)
                        <ul class="drop-down closed col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="nav-button">Lecture: {{$lecture->lecturename}}</div></li>
                            @foreach($topics as $topic)
                            @if($lecture->id==$topic->lecture_id)
                            <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topicDiv" data-topicid="{{$topic->id}}">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 topics" href="#">Topic: {{$topic->topicname}}</div>
                                <button type="button" class="js-like-button like-btn" id="questionBtn"><img src="/img/question-green.png" style="height: 20px"/>︎&nbsp; {{ Auth::user()->understands()->where('topic_id', $topic->id)->first() ? Auth::user()->understands()->where('topic_id', $topic->id)->first()->understand == 1 ? 'Cancel Request' : 'I don\'t understand' : 'I don\'t understand'  }}</button>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                        @endforeach
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </li>

        <li>
            <input type="radio" name="tabs" id="tab2" href="#tab2"/>
            <label for="tab2"
                   role="tab"
                   aria-selected="false"
                   aria-controls="panel2"
                   tabindex="1">Chat room</label>
            <div id="tab-content2"
                 class="tab-content"
                 role="tabpanel"
                 aria-labelledby="specification"
                 aria-hidden="true">
                <!--to be changed, only ui for now-->
                <div class="col-lg-12">
                <form method="POST" action="/swithclass" class="col-lg-12">
                    {{csrf_field()}}
                    <p class="">Switch Classroom</p>
                    <select type="text" class="form-control" name="switch_class">
                        @foreach($user_courses as $user_course)
                        @if($user_course->user_id==Auth::user()->id)
                        <option data-courseid="{{$user_course->course_id}}" >{{Course::where('id',$user_course->course_id)->first()->coursename}}</option>
                        @endif
                        @endforeach
                    </select>
                    <button class="sendMessage col-lg-2 col-md-2" id="switchclass">Confirm</button>
                </form></div>
                <div class="container_chat clearfix">
                    @if($currentcourse!='')
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="chat-about">
                                <div class="chat-with">Chat room for {{$currentcourse}}</div>
                                <div class="chat-num-messages"></div>
                            </div>
                            <i class="fa fa-star"></i>
                        </div> <!-- end chat-header -->

                        <div class="chat-history">
                            <ul class="messageDivv" id="msg">
                                @foreach($messages as $message)
                                @if(Course::where('id',$message->course_id)->first()->coursename==$currentcourse)
                                    @if(Auth::user()->name == Auth::user()->where('id',$message->user_id)->first()->name)
                                    <li style="width: 100%">
                                        <div class="message-data align-right">
                                            <span class="message-data-time">{{$message->created_at}}</span>
                                        </div>
                                        <div class="message other-message float-right">
                                            {{$message->content}}
                                        </div>
                                        <div class="col-lg-12" data-messageid="{{$message->id}}">
                                            @if( Auth::user()->msgunderstands()->where('message_id',$message->id)->first())
                                            <button class="float-right msgUnderstand"><img class="understandimg" style="width: 30px;height:auto;" src="img/ques-red.png"/></button>
                                            @else
                                            <button class="float-right msgUnderstand"><img class="understandimg" style="width: 30px;height:auto;" src="img/ques-black.png"/></button>
                                            @endif
                                        </div>
                                    </li>
                                    @else
                                    <li style="width: 100%">
                                        <div class="message-data">
                                            <span class="message-data-time">{{$message->created_at}}</span>
                                        </div>
                                        <div class="message my-message">
                                            {{$message->content}}
                                        </div>
                                        <div class="col-lg-12" data-messageid="{{$message->id}}">
                                            @if( Auth::user()->msgunderstands()->where('message_id',$message->id)->first())
                                            <button class="float-left msgUnderstand"><img class="understandimg" style="width: 30px;height:auto;" src="img/ques-red.png"/></button>
                                            @else
                                            <button class="float-left msgUnderstand"><img class="understandimg" style="width: 30px;height:auto;" src="img/ques-black.png"/></button>
                                            @endif
                                        </div>
                                    </li>
                                    @endif
                                @endif
                                @endforeach

                            </ul>

                        </div> <!-- end chat-history -->
                        <div style="background-color: #2e3436;padding:20px;border-radius: 0px 0px 10px 10px">
                            {{csrf_field()}}
                                <input type="hidden" name="class" data-class="{{$currentcourse}}" value="{{$currentcourse}}" >
                                <input type="hidden" name="user" value="{{Auth::user()->id}}" >
                            <input name="msgcontent" id="message-to-send1" class="form-control" placeholder ="Type your message" rows="3">
                            <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-file-image-o"></i>

                            <button class="sendMessage float-right" id="sendMessage" style="margin-top: 10px">Send</button>
                        </div>
                      <!-- end chat-message -->
                    </div> <!-- end chat -->
                    @endif
                </div> <!-- end container -->
            </div>
        </li>

       <script>
            $(document).on('click','#sendMessage', function(evt) {
                evt.preventDefault();
                var $btn = $(this);
                var contentmsg = $('input[name=msgcontent]').val();
                console.log(contentmsg);
                var courseId = $('input[name=class]').val();
                var userId = $('input[name=user]').val();
                $.ajax({
                    method: 'POST',
                    url:'/sendMessage',
                    data:{contentmsg:contentmsg,courseId:courseId,_token:$('input[name=_token]').val(),userId:userId},
                    success: function(data){
                        $('#msg').append('<li style="width: 100%"><div class="message-data align-right"><span class="message-data-name"><i class="fa fa-circle online"></i></span> <span class="message-data-time">'+data.created_at+'</span> </div> <div class="message other-message float-right">'+data.content+' </div> </li>')
                    }
                });
                $('input[name=msgcontent]').val('');

            });
        </script>
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
                    <div class="col-lg-12 addBtn">Create Class
                        <a href="{{ url('/addclass') }}"><image src="/img/add.png" style="height: 50px"/></a>
                    </div>

                    <ul>
                        @foreach($user_courses as $user_course)
                        @if($user_course->user_id==Auth::user()->id)
                        <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 coursescourses">Course Name: {{Course::where('id',$user_course->course_id)->first()->coursename}}</div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 addBtn">Add Content
                                <a href="{{ url('/addcontent') }}"><image src="/img/small-add.png" style="height: 30px"/></a>
                            </div>
                            @foreach($lectures as $lecture)
                            @if($lecture->course_id==$user_course->course_id)
                            <ul class="drop-down closed col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="nav-button">Lecture: {{$lecture->lecturename}}</div></li>
                                @foreach($topics as $topic)
                                @if($lecture->id==$topic->lecture_id)
                                <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topicDiv">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 topics" href="#">Topic: {{$topic->topicname}}</div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 understand">{{Understand::where('understand',1)->where('topic_id',$topic->id)->count()}} Student don't understand</div>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                            @endif
                            @endforeach
                        </li>
                        @endif
                        @endforeach
                    </ul>
            </div>
        </li>

        <li>
            <input type="radio" name="tabs" id="tab2" />
            <label for="tab2"
                   role="tab"
                   aria-selected="false"
                   aria-controls="panel2"
                   tabindex="0">Chat room</label>
            <div id="tab-content2"
                 class="tab-content"
                 role="tabpanel"
                 aria-labelledby="specification"
                 aria-hidden="true">
                <!--to be changed, only ui for now-->
                <div class="col-lg-12">
                    <form method="POST" action="/swithclass" class="col-lg-12">
                        {{csrf_field()}}
                        <p class="">Switch Classroom</p>
                        <select type="text" class="form-control" name="switch_class">
                            @foreach($user_courses as $user_course)
                            @if($user_course->user_id==Auth::user()->id)
                            <option data-courseid="{{$user_course->course_id}}" >{{Course::where('id',$user_course->course_id)->first()->coursename}}</option>
                            @endif
                            @endforeach
                        </select>
                        <button class="sendMessage col-lg-2 col-md-2" id="switchclass">Confirm</button>
                    </form></div>
                <div class="container_chat clearfix">
                    @if($currentcourse!='')
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="chat-about">
                                <div class="chat-with">Chat room for {{$currentcourse}}</div>
                                <div class="chat-num-messages"></div>
                            </div>
                            <i class="fa fa-star"></i>
                        </div> <!-- end chat-header -->

                        <div class="chat-history">
                            <ul class="messageDivv" id="msg">
                                @foreach($messages as $message)
                                @if(Course::where('id',$message->course_id)->first()->coursename==$currentcourse)
                                @if(Auth::user()->name == Auth::user()->where('id',$message->user_id)->first()->name)
                                <li style="width: 100%">
                                    <div class="message-data align-right">
                                        <span class="message-data-time">{{$message->created_at}}</span>
                                    </div>
                                    <div class="message other-message float-right">
                                        {{$message->content}}
                                    </div>
                                    @if(Msgunderstd::where('buttonPressed',0)->where('message_id',$message->id)->count()>0)
                                    <div class="col-lg-12 float-right" style="color:red" data-messageid="{{$message->id}}">
                                        {{Msgunderstd::where('buttonPressed',0)->where('message_id',$message->id)->count()}} student don't understand this
                                    </div>
                                    @endif
                                </li>
                                @else
                                <li style="width: 100%">
                                    <div class="message-data">
                                        <span class="message-data-time">{{$message->created_at}}</span>
                                    </div>
                                    <div class="message my-message">
                                        {{$message->content}}
                                    </div>
                                    @if(Msgunderstd::where('buttonPressed',0)->where('message_id',$message->id)->count()>0)
                                    <div class="col-lg-12 float-right" style="color:red" data-messageid="{{$message->id}}">
                                        {{Msgunderstd::where('buttonPressed',0)->where('message_id',$message->id)->count()}} student don't understand this
                                    </div>
                                    @endif
                                </li>
                                @endif
                                @endif
                                @endforeach

                            </ul>

                        </div> <!-- end chat-history -->
                        <div style="background-color: #2e3436;padding:20px;border-radius: 0px 0px 10px 10px">
                            {{csrf_field()}}
                            <input type="hidden" name="class" data-class="{{$currentcourse}}" value="{{$currentcourse}}" >
                            <input type="hidden" name="user" value="{{Auth::user()->id}}" >
                            <input name="msgcontent" id="message-to-send1" class="form-control" placeholder ="Type your message" rows="3">
                            <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-file-image-o"></i>

                            <button class="sendMessage float-right" id="sendMessage" style="margin-top: 10px">Send</button>
                        </div>
                        <!-- end chat-message -->
                    </div> <!-- end chat -->
                    @endif
                </div> <!-- end container -->
            </div>
        </li>
        <script>
            $(document).on('click','#sendMessage', function(evt) {
                evt.preventDefault();
                var $btn = $(this);
                var contentmsg = $('input[name=msgcontent]').val();
                console.log(contentmsg);
                var courseId = $('input[name=class]').val();
                var userId = $('input[name=user]').val();
                $.ajax({
                    method: 'POST',
                    url:'/sendMessage',
                    data:{contentmsg:contentmsg,courseId:courseId,_token:$('input[name=_token]').val(),userId:userId},
                    success: function(data){
                        $('#msg').append('<li style="width: 100%"><div class="message-data align-right"><span class="message-data-name"><i class="fa fa-circle online"></i> {{Auth::user()->name}}</span> <span class="message-data-time">'+data.created_at+'</span> </div> <div class="message other-message float-right">'+data.content+' </div> </li>')
                    }
                });
                $('input[name=msgcontent]').val('');

            });
        </script>
    </ul>

                        </div> <!-- end chat-history -->

                    </div> <!-- end chat -->
                </div> <!-- end container -->
            </div>
        </li>

        <script>
            $(document).on('click','#sendMessage', function(evt) {
                evt.preventDefault();
                var $btn = $(this);
                var contentmsg = $('input[name=msgcontent]').val();
                console.log(contentmsg);
                var courseId = evt.target.dataset['class'];
                $.ajax({
                    method: 'POST',
                    url:'/sendMessage',
                    data:{contentmsg:contentmsg,courseId:courseId,_token:$('input[name=_token]').val()},
                    success: function(data){
                        $('#msg').append('<li style="width: 100%"><div class="message-data align-right"><span class="message-data-name"><i class="fa fa-circle online"></i> </span> <span class="message-data-time">'+data.created_at+'</span> </div> <div class="message other-message float-right">'+data.content+' </div> </li>')
                    }
                });
                $('input[name=msgcontent]').val('');

            });
        </script>
    </ul>
    @section('script')
    @stop
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
