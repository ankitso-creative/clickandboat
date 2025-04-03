<?php 
namespace App\Repositories\Customer;

use App\Events\Auth\ChatMessageSent;
use App\Models\Message;
class ChatRepository 
{

    public function sendMessage($request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chat_images', 'public');
        }
        
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'image' => $imagePath,
        ]);

        broadcast(new ChatMessageSent($message))->toOthers();

        return response()->json($message);
    }
    public function fetchMessages($receiver_id)
    {
        $messages = Message::where(function ($query) use ($receiver_id) {
            $query->where('sender_id', auth()->id())->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($receiver_id) {
            $query->where('sender_id', $receiver_id)->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }
}