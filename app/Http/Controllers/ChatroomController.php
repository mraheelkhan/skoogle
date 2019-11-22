<?php

namespace App\Http\Controllers;

use App\Chatroom;
use App\ChatroomParticipant;
use App\ChatroomMessage;
use App\User;
use Illuminate\Http\Request;

class ChatroomController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user_id = auth()->user()->id;
        $rooms = ChatroomParticipant::where('user_id', $auth_user_id)->pluck('room_id');
        
        $chatrooms = Chatroom::whereIn('id',$rooms)->where('is_deleted', 0)->get();
        // $chatrooms = Chatroom::whereIn('id',$rooms)->where('room_type','single')->get();
        $allusers = User::where('status', 1)->get();
        $groupchats = Chatroom::where('room_type', 'group')->where('is_deleted', 0)->get();

        // dd($chatrooms);
        // //$rooms = Chatroom::where('user_id', auth()->user()->id)->get();
        // $added_users_id = ChatroomParticipant::whereIn('room_id', $chatrooms)->pluck('user_id');
        
        // $allusers = User::whereNotIn('id',$added_users_id)->where('id','!=', $auth_user_id)->get();
        
        // $allcontacts = User::where('id','!=',$auth_user_id)->get();
        //dd($allcontacts);
        return view('chat.index', compact('chatrooms', 'allusers', 'groupchats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new ChatroomMessage;
        $message->room_id = $request->roomId;
        $message->message = $request->Message;
        $message->user_id = auth()->user()->id;
        $message->save();

        $success = 1;
        $msg = "Your Message is Sent Successfully.";
        $array = array(
            'msg' => $msg,
            'success' => $success
        );
        return $array;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chatroom  $chatroom
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room_id = $id;
        $auth_user_id = auth()->user()->id;
        $rooms = ChatroomParticipant::where('user_id', $auth_user_id)->pluck('room_id');
        $chatrooms = Chatroom::whereIn('id',$rooms)->get();
        // $chatrooms = Chatroom::whereIn('id',$rooms)->where('room_type','single')->get();
        $groupchats = Chatroom::where('room_type', 'group')->where('is_deleted', 0)->get();
        $messages = ChatroomMessage::where('room_id', $id)->get();
        // dd($messages);
        $allusers = User::where('status', 1)->whereNotIn('id', $rooms)->get();
        return view('chat.conversation', compact('messages', 'chatrooms', 'room_id', 'allusers', 'groupchats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chatroom  $chatroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Chatroom $chatroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chatroom  $chatroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chatroom $chatroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chatroom  $chatroom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chatroom = Chatroom::findOrFail($id);
        if($chatroom->user_id == auth()->user()->id){
            $chatroom->is_deleted = 1;
            $chatroom->save();
            return redirect(route('Chatroom'));
        }
        return redirect()->back();


    }

    public function createChatroomSingle(Request $request){
        $chatroom = new Chatroom;
        $chatroom->user_id = auth()->user()->id;
        $user_id = User::findOrFail($request->with_chat_id);
        $chatroom->name = auth()->user()->fname . " - " . $user_id->fname;
        $chatroom->save();

        $participant1 = new ChatroomParticipant;
        $participant1->room_id = $chatroom->id;
        $participant1->user_id = auth()->user()->id;
        $participant1->save();
        $participant2 = new ChatroomParticipant;
        $participant2->room_id = $chatroom->id;
        $participant2->user_id = $user_id->id;
        $participant2->save();
        return redirect()->back();
    }

    public function createChatroom(Request $request){
        $validated = $request->validate([   
            "chatroom_name" => 'required',
            "chatroom_code" => 'required|min:4|max:25',
        ]);

        $chatroom = new Chatroom;
        $chatroom->user_id = auth()->user()->id;
        $chatroom->name = $request->chatroom_name;
        $chatroom->code = $request->chatroom_code;
        $chatroom->room_type = 'group';
        $chatroom->save();
        return redirect()->back();
    }

    public function joinChatroom(Request $request){

        $roomAuth = Chatroom::findOrFail($request->room_id);

        if($request->code == $roomAuth->code){
            $participant = new ChatroomParticipant;
            $participant->room_id = $request->room_id;
            $participant->user_id = auth()->user()->id;
            $participant->save();
            return redirect(route('ChatUserShow', $request->room_id));
        } else {
            Session::flash('message', 'Wrong joining Code. <script>swal.fire(Wrong Code","Wrong joining Code", "error");</script>'); 
            return redirect()->back();
        }
    }
}
