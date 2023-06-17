<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    public function store(Request $request){
        $message = new Message();
        $message->fullname = $request->input('fullname');
        $message->email = $request->input('email');
        $message->message = $request->input('message');
        $message->save();

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function viewMessage(){
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin-dashboard.message', compact('messages'));
    }

    public function messageViewRequest($id){
        $message = Message::find($id);
        dd($message);
        return response()->json([
            'id' => $message->id,
            'fullname' => $message->fullname,
            'email' => $message->email,
            'message' => $message->message,
            'created_at' => $message->created_at
        ]);
    }
    public function show(Message $message){
        return response()->json([
            'fullname' => $message->fullname,
            'email' => $message->email,
            'created_at' => $message->created_at->format('F j, Y'),
            'message' => $message->message,
        ]);
    }

    public function destroy(Message $message){
        $message->delete();
        return response()->json(['message' => 'Message deleted successfully']);
    }
}
