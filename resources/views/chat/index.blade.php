@extends('layouts.home')
@section('content')
<style>
.chat_img img {
  max-width: 100%;
}
.incoming_msg_img img {
  max-width: 100%;
}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
</style>
<section class="blog_tow_area" style="margin: 0px;">
    <div class="">
            @if(Session::has('message'))
            <p class="alert alert-success">{!! Session::get('message') !!}</p>    
        @elseif(Session::has('error'))
            <p class="alert alert-danger">{!! Session::get('error') !!}</p>
        @endif
        @if(session('failed'))
            <script>
              $( document ).ready(function() {
                swal.fire("Failed", "{!! Session::get('error') !!}", "error");
              });
              
            </script>
        @endif
        <div class="container-fluid">
            <h3 class=" text-center">Messaging</h3>
            <div class="messaging">
                  <div class="inbox_msg">
                    <div class="inbox_people">
                      <div class="headind_srch">
                        <div class="recent_heading" style="    width: 100%;">
                          <div class="col-md-5">
                            <h4>All Chats</h4>

                          </div>
                          <div class="col-md-7">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                              New Chat
                            </button>
                            @if(auth()->user()->isPro == 1)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#chatroom">
                                        Chatroom
                                      </button>
                                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#joinroom">
                                        Join Room
                                      </button>
                                    @else 
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#joinroom">
                                        Join Room
                                      </button>
                                      @endif
                          </div>
                        </div>
                        {{-- <div class="srch_bar">
                          <div class="stylish-input-group">
                            <input type="text" class="search-bar"  placeholder="Search" >
                            <span class="input-group-addon">
                            <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                            </span> </div>
                        </div> --}}
                      </div>
                      <div class="inbox_chat">
                        
                        @foreach($chatrooms as $room)
                        
                        <div class="chat_list">
                          <div class="chat_people">
                            <div class="chat_img"> 
                              <img src="https://ptetutorials.com/images/user-profile.png" alt="skoogle"> </div>
                            <div class="chat_ib">
                              <a href="{{route('ChatUserShow', $room->id)}}"><h5>{{$room->name}} </a>
                                {{-- <span class="chat_date">Dec 25</span></h5> --}}
                              {{-- <p>Test, which is a new approach to have all solutions 
                                astrology under one roof.</p> --}}
                            </div>
                          </div>
                        </div>
                        @endforeach
                        
                      </div>
                    </div>
                    <div class="mesgs">
                      <div class="msg_history">
                        <h1 class="text-center"> Select Conversation </h1>
                      </div>
                      <div class="type_msg">
                        <div class="input_msg_write">
                          <input type="text" class="write_msg" placeholder="Type a message" />
                          <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  
                  <p class="text-center top_spac"> Design by <a target="_blank" href="#">Sunil Rajput</a></p>
                  
                </div></div>
    </div>
</section>
{{-- start chat with someone --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Start New Chat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Action</td>
          </tr>
          @foreach($allusers as $user)
          <tr>
            <td>{{$user->fname . " " . $user->lname }}</td>
            <td>{{$user->email}}</td>
            <td><form method="POST" action="{{route('ChatUserCreateStore')}}">
              @csrf
              <input type="hidden" name="with_chat_id" value="{{$user->id}}"/>
              <input type="submit" value="Start Chat" class="btn btn-primary btn-sm">
            </form></td>
          </tr>
          @endforeach
        </table>
      </div>
      
    </div>
  </div>
</div>
{{-- create chatroom --}}
<div class="modal fade" id="chatroom" tabindex="-1" role="dialog" aria-labelledby="chatroomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatroomLabel">New Chatroom</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('ChatUserRoomStore') }}" method="POST">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control" name="chatroom_name" placeholder="Enter Chatroom Name"/>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="chatroom_code" placeholder="Enter Chatroom Passcode"/>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Create Chatroom"/>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
{{--join chatroom  --}}
<div class="modal fade" id="joinroom" tabindex="-1" role="dialog" aria-labelledby="joinroomLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="joinroomLabel">Join Chatroom</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <table class="table">
                  <tr>
                    <td>Room Name</td>
                    <td>Owner</td>
                    <td>Action</td>
                  </tr>
            @foreach($groupchats as $group)
            <tr>
              <td>{{ $group->name }}</td>
              <td>{{ $group->user->fname }}</td>
              <td>
                  <p>
                      <a class="btn btn-primary btn-xs" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Join
                      </a>
                      @if($group->user_id == auth()->user()->id)
                      <a class="btn btn-danger btn-xs" href="{{route('ChatroomDelete', $group->id)}}">
                        <i class="fa fa-trash"></i>
                      </a>
                      @endif
                    </p>
                    <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                      <form action="{{ route('ChatJoinChatroom')}}" method="POST">
                        @csrf
                        <input type="text" name="code" class="form-control" placeholder="Enter chatroom joining code"/>
                        <input type="hidden" name="room_id" value="{{$group->id}}" class="form-control" placeholder="Enter chatroom joining code"/>
                        <input type="submit" class="form-control"/>
                      </form>
                    </div>
                    </div>
              </td>
            </tr>
            
            @endforeach
              </table>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endsection