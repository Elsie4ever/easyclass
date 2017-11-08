<?php
use App\Course;
use App\Lecture;
use App\Topic;
use App\Understand;
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
                        @foreach($courses as $course)
                        <option data-courseid="{{$course->id}}" >{{Course::where('id',$course->id)->first()->coursename}}</option>
                        @endforeach
                    </select>
                    <button class="sendMessage col-lg-2 col-md-2" id="switchclass">Confirm</button>
                </form></div>
                <div class="container_chat clearfix">

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
                                <li class="clearfix">
                                    <div class="message-data align-right">
                                        <span class="message-data-time" >10:10 AM, Today</span> &nbsp; &nbsp;
                                        <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>

                                    </div>
                                    <div class="message other-message float-right">
                                        Hi Vincent, how are you? How is the project coming along?
                                    </div>
                                </li>

                                <li>
                                    <div class="message-data">
                                        <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
                                        <span class="message-data-time">10:12 AM, Today</span>
                                    </div>
                                    <div class="message my-message">
                                        Are we meeting today? Project has been already finished and I have results to show you.
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <div class="message-data align-right">
                                        <span class="message-data-time" >10:14 AM, Today</span> &nbsp; &nbsp;
                                        <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>

                                    </div>
                                    <div class="message other-message float-right">
                                        Well I am not sure. The rest of the team is not here yet. Maybe in an hour or so? Have you faced any problems at the last phase of the project?
                                    </div>
                                </li>

                                <li>
                                    <div class="message-data">
                                        <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
                                        <span class="message-data-time">10:20 AM, Today</span>
                                    </div>
                                    <div class="message my-message">
                                        Actually everything was fine. I'm very excited to show this to our team.
                                    </div>
                                </li>
                                @foreach($messages as $message)
                                    @if(Auth::user()->name == Auth::user()->where('id',$message->user_id)->first()->name)
                                    <li style="width: 100%">
                                        <div class="message-data align-right">
                                            <span class="message-data-name"><i class="fa fa-circle online"></i>{{Auth::user()->where('id',$message->user_id)->first()->name}}</span>
                                            <span class="message-data-time">{{$message->created_at}}</span>
                                        </div>
                                        <div class="message other-message float-right">
                                            {{$message->content}}
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="float-right"><img style="width: 30px;height:auto;" src="img/ques-black.png"/></button>
                                        </div>
                                    </li>
                                    @else
                                    <li style="width: 100%">
                                        <div class="message-data">
                                            <span class="message-data-name"><i class="fa fa-circle online"></i>{{Auth::user()->where('id',$message->user_id)->first()->name}}</span>
                                            <span class="message-data-time">{{$message->created_at}}</span>
                                        </div>
                                        <div class="message my-message">
                                            {{$message->content}}
                                        </div>
                                    </li>
                                    @endif
                                @endforeach

                            </ul>

                        </div> <!-- end chat-history -->
                        <div>
                            {{csrf_field()}}
                                <input type="hidden" name="class" data-class="{{$currentcourse}}" value="{{$currentcourse}}" >
                                <input type="hidden" name="user" value="{{Auth::user()->id}}" >
                            <input name="msgcontent" id="message-to-send1" placeholder ="Type your message" rows="3">
                            <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-file-image-o"></i>

                            <button class="sendMessage" id="sendMessage">Send</button>
                        </div>
                      <!-- end chat-message -->
                    </div> <!-- end chat -->
                </div> <!-- end container -->
            </div>
        </li>
        <script>
            var urlLike = '{{ route('sendMessage') }}';
            $(document).ready(function(){
                setTimeout(realTime,2000);
            });
            function realTime(){
                $.ajax({
                    type:'post',
                    url:'/chat/get',
                    data:{
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function(data){
                        $('#msg').replaceWith('<ul class="messageDivv" id="msg"></ul>');
                        for(var i = 0; i < data.length; i++){
                                $('#msg').append('<li style="width: 100%"><div class="message-data"><span class="message-data-name"><i class="fa fa-circle online"></i></span> <span class="message-data-time">'+data[i].created_at+'</span> </div> <div class="message my-message">'+data[i].content+' </div> </li>')
                        }
                    }
                });
                setTimeout(realTime,2000);
            }
        </script>
        <script>
            $(document).on('click','#sendMessage', function(evt) {
                evt.preventDefault();
                var $btn = $(this);
                var contentmsg = $('input[name=msgcontent]').val();
                console.log(contentmsg);
                var courseId = $('input[name=class]').val();
                var userId = $('input[name=user]').val();
                console.log(courseId);
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
                <div class="container_chat clearfix">
                    <div class="people-list" id="people-list1">
                        <div class="search">
                            <input type="text" placeholder="search" />
                            <i class="fa fa-search"></i>
                        </div>
                        <ul class="list">
                            <li class="clearfix">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
                                <div class="about">
                                    <div class="name">Vincent Porter</div>
                                    <div class="status">
                                        <i class="fa fa-circle online"></i> online
                                    </div>
                                </div>
                            </li>

                            <li class="clearfix">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_02.jpg" alt="avatar" />
                                <div class="about">
                                    <div class="name">Aiden Chavez</div>
                                    <div class="status">
                                        <i class="fa fa-circle offline"></i> left 7 mins ago
                                    </div>
                                </div>
                            </li>

                            <li class="clearfix">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_03.jpg" alt="avatar" />
                                <div class="about">
                                    <div class="name">Mike Thomas</div>
                                    <div class="status">
                                        <i class="fa fa-circle online"></i> online
                                    </div>
                                </div>
                            </li>

                            <li class="clearfix">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_04.jpg" alt="avatar" />
                                <div class="about">
                                    <div class="name">Erica Hughes</div>
                                    <div class="status">
                                        <i class="fa fa-circle online"></i> online
                                    </div>
                                </div>
                            </li>

                            <li class="clearfix">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_05.jpg" alt="avatar" />
                                <div class="about">
                                    <div class="name">Ginger Johnston</div>
                                    <div class="status">
                                        <i class="fa fa-circle online"></i> online
                                    </div>
                                </div>
                            </li>

                            <li class="clearfix">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_06.jpg" alt="avatar" />
                                <div class="about">
                                    <div class="name">Tracy Carpenter</div>
                                    <div class="status">
                                        <i class="fa fa-circle offline"></i> left 30 mins ago
                                    </div>
                                </div>
                            </li>

                            <li class="clearfix">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_07.jpg" alt="avatar" />
                                <div class="about">
                                    <div class="name">Christian Kelly</div>
                                    <div class="status">
                                        <i class="fa fa-circle offline"></i> left 10 hours ago
                                    </div>
                                </div>
                            </li>

                            <li class="clearfix">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_08.jpg" alt="avatar" />
                                <div class="about">
                                    <div class="name">Monica Ward</div>
                                    <div class="status">
                                        <i class="fa fa-circle online"></i> online
                                    </div>
                                </div>
                            </li>

                            <li class="clearfix">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_09.jpg" alt="avatar" />
                                <div class="about">
                                    <div class="name">Dean Henry</div>
                                    <div class="status">
                                        <i class="fa fa-circle offline"></i> offline since Oct 28
                                    </div>
                                </div>
                            </li>

                            <li class="clearfix">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_10.jpg" alt="avatar" />
                                <div class="about">
                                    <div class="name">Peyton Mckinney</div>
                                    <div class="status">
                                        <i class="fa fa-circle online"></i> online
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="chat">
                        <div class="chat-header clearfix">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" alt="avatar" />

                            <div class="chat-about">
                                <div class="chat-with">Chat with Vincent Porter</div>
                                <div class="chat-num-messages">already 1 902 messages</div>
                            </div>
                            <i class="fa fa-star"></i>
                        </div> <!-- end chat-header -->

                        <div class="chat-history">
                            <ul>
                                <li class="clearfix">
                                    <div class="message-data align-right">
                                        <span class="message-data-time" >10:10 AM, Today</span> &nbsp; &nbsp;
                                        <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>

                                    </div>
                                    <div class="message other-message float-right">
                                        Hi Vincent, how are you? How is the project coming along?
                                    </div>
                                </li>

                                <li>
                                    <div class="message-data">
                                        <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
                                        <span class="message-data-time">10:12 AM, Today</span>
                                    </div>
                                    <div class="message my-message">
                                        Are we meeting today? Project has been already finished and I have results to show you.
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <div class="message-data align-right">
                                        <span class="message-data-time" >10:14 AM, Today</span> &nbsp; &nbsp;
                                        <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>

                                    </div>
                                    <div class="message other-message float-right">
                                        Well I am not sure. The rest of the team is not here yet. Maybe in an hour or so? Have you faced any problems at the last phase of the project?
                                    </div>
                                </li>

                                <li>
                                    <div class="message-data">
                                        <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
                                        <span class="message-data-time">10:20 AM, Today</span>
                                    </div>
                                    <div class="message my-message">
                                        Actually everything was fine. I'm very excited to show this to our team.
                                    </div>
                                </li>

                                <li>
                                    <div class="message-data">
                                        <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
                                        <span class="message-data-time">10:31 AM, Today</span>
                                    </div>
                                    <i class="fa fa-circle online"></i>
                                    <i class="fa fa-circle online" style="color: #AED2A6"></i>
                                    <i class="fa fa-circle online" style="color:#DAE9DA"></i>
                                </li>
                                @foreach($messages as $message)
                                <li>
                                    <div class="message-data">
                                        <span class="message-data-name"><i class="fa fa-circle online"></i>{{$message->user_id}}</span>
                                        <span class="message-data-time">{{$message->created_at}}</span>
                                    </div>
                                    <div class="message my-message">
                                        {{$message->content}}
                                    </div>
                                </li>
                                @endforeach

                            </ul>

                        </div> <!-- end chat-history -->

                        <div class="chat-message clearfix">
                            <textarea name="message-to-send" id="message-to-send1" placeholder ="Type your message" rows="3"></textarea>

                            <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-file-image-o"></i>

                            <button>Send</button>

                        </div> <!-- end chat-message -->

                    </div> <!-- end chat -->
                </div> <!-- end container -->
            </div>
        </li>
        <script>
            var urlLike = '{{ route('sendMessage') }}';
            $(document).ready(function(){
                setTimeout(realTime,2000);
            });
            function realTime(){
                $.ajax({
                    type:'post',
                    url:'/chat/get',
                    data:{
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function(data){
                        $('#msg').replaceWith('<ul class="messageDivv" id="msg"></ul>');
                        for(var i = 0; i < data.length; i++){
                            $('#msg').append('<li style="width: 100%"><div class="message-data align-right"><span class="message-data-name"><i class="fa fa-circle online"></i> {{Auth::user()->name}}</span> <span class="message-data-time">'+data[i].created_at+'</span> </div> <div class="message other-message float-right">'+data[i].content+' </div> </li>')
                        }
                    }
                });
                setTimeout(realTime,2000);
            }
        </script>
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
                        $('#msg').append('<li style="width: 100%"><div class="message-data align-right"><span class="message-data-name"><i class="fa fa-circle online"></i> {{Auth::user()->name}}</span> <span class="message-data-time">'+data.created_at+'</span> </div> <div class="message other-message float-right">'+data.content+' </div> </li>')
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
