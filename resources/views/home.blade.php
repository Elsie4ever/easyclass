<?php
use App\Course;
?>
@extends('layouts.app')
<title>easyClass</title>
<link href="css/home.css" rel="stylesheet">
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
                <ul class="drop-down closed">
                    <li class="col-lg-12"><div class="nav-button">Lecture 1</div></li>
                    <li class="col-lg-12"><div href="#">About</div></li>
                    <li class="col-lg-12"><div href="#">Library</div></li>
                    <li class="col-lg-12"><div href="#">Contact</div></li>
                </ul>
                <ul class="drop-down closed">
                    <li class="col-lg-12"><div class="nav-button">Lecture 2</div></li>
                    <li class="col-lg-12"><div href="#">About</div></li>
                    <li class="col-lg-12"><div href="#">Library</div></li>
                    <li class="col-lg-12"><div href="#">Contact</div></li>
                </ul>
                <ul class="drop-down closed">
                    <li class="col-lg-12"><div class="nav-button">Lecture 3</div></li>
                    <li class="col-lg-12"><div href="#">About</div></li>
                    <li class="col-lg-12"><div href="#">Library</div></li>
                    <li class="col-lg-12"><div href="#">Contact</div></li>
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
                        <li class="col-lg-12 courses">Course Name:{{Course::where('id',$user_course->course_id)->first()->coursename}}
                            <div class="addBtn">Add Content
                                <a href="{{ url('/addcontent') }}"><image src="/img/add.png" style="height: 50px"/></a>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    <ul class="col-lg-12 drop-down closed">
                        <li class="col-lg-12"><div class="nav-button">Lecture 1</div></li>
                        <li class="col-lg-12"><div href="#">About</div></li>
                        <li class="col-lg-12"><div href="#">Library</div></li>
                        <li class="col-lg-12"><div href="#">Contact</div></li>
                    </ul>
                    <ul class="col-lg-12 drop-down closed">
                        <li class="col-lg-12"><div class="nav-button">Lecture 2</div></li>
                        <li class="col-lg-12"><div href="#">About</div></li>
                        <li class="col-lg-12"><div href="#">Library</div></li>
                        <li class="col-lg-12"><div href="#">Contact</div></li>
                    </ul>
                    <ul class="col-lg-12 drop-down closed">
                        <li class="col-lg-12"><div class="nav-button">Lecture 3</div></li>
                        <li class="col-lg-12"><div href="#">About</div></li>
                        <li class="col-lg-12"><div href="#">Library</div></li>
                        <li class="col-lg-12"><div href="#">Contact</div></li>
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
