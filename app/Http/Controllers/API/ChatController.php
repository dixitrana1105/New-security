<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Create a new chat
    public function createChat(Request $request)
    {
        // dd($request);
        $chat = Chat::create(['name' => $request->name, 'building_id' => $request->building_id], );

        return response()->json($chat, 201);
    }

    // Add a message to a chat
    public function addMessage(Request $request, $chatId)
    {
        // dd($request);
        $message = ChatMessage::create([
            'chat_id' => $chatId,
            'message' => $request->message,
            'building_id' =>  $request->building_id,
        ]);

        return response()->json($message, 201);
    }

    // Get all messages in a chat
    public function getMessages($chatId)
    {
        $messages = ChatMessage::where('chat_id', $chatId)->get();

        return response()->json($messages);
    }
}
