<?php

namespace App\Http\Controllers\chat;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Recipient;
use App\Traits\GeneralTrait;
use App\Transformers\IndexTransformer;
use App\Transformers\MessageTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $user = Auth::user();
        $conversations = $user->conversations()->with([
            "lastMessage" => function ($builder) {
                $builder->with(["sender" => function ($builder) {
                    $builder->select("id", "name");
                }]);
            },
            "members" => function ($builder) use ($user) {
                $builder->where("user_id", "<>", $user->id)->select("name");
            }
        ])->withCount([
            'recipients as new_messages' => function ($builder) use ($user) {
                $builder->where('recipients.user_id', $user->id)
                    ->whereNull('read_at');
            }
        ])->get();



        $ConversationTransformer = [];
        foreach ($conversations as $index => $conversation) {
            $ConversationTransformer[$index] = fractal($conversation, new IndexTransformer())->toArray();
            $ConversationTransformer[$index] = $ConversationTransformer[$index]["data"];
        }
        return $this->returnData("conversations", $ConversationTransformer, "count_conversations", $conversations->count());
    }
    public function show(Request $request)
    {
        $conversation_id = $request->conversation_id;
        $conversation = Conversation::find(3);
        $messages = $conversation->messages()->with('sender')->orderByDesc("id")->get();
        $MessageTransformer = [];
        foreach ($messages as $index => $message) {
            $MessageTransformer[$index] = fractal($message, new MessageTransformer())->toArray();
            $MessageTransformer[$index] = $MessageTransformer[$index]["data"];
        }
        return $this->returnData("messages", $MessageTransformer, "count_messages", $messages->count());
    }
    public function NumberOfUnreadMessage()
    {

        $user = Auth::user();
        $unread_message = $user->unreadmessage();
        return $this->returnData("Number_Of_Unread_Messages", $unread_message);
    }
    public function markAsRead(Request $request)
    {
        $conversation_id = $request->conversation_id;
        $message_ids = Conversation::find($conversation_id)->messages()->pluck('id')->toArray();
        Recipient::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->whereIn("message_id", $message_ids)
            ->update([
                'read_at' => Carbon::now(),
            ]);
        return $this->returnData("message", 'Messages marked as read');
    }
}
