<?php

namespace App\Transformers;

use App\Models\Conversation;
use League\Fractal\TransformerAbstract;

class IndexTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */

    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Conversation $conversation)
    {


        return [
            "Conversation_Id"=>$conversation->id,
            "Conversation_Label"=> $conversation->members->isNotEmpty()==true?$conversation->members[0]->name:"anonymous",
            "Conversation_Type"=>$conversation->type,
            "Conversation_Number_New_Messages"=>$conversation->new_messages,
            "Conversation_Created_at"=>$conversation->created_at->format("Y-m-d H:i:s"),
            "Conversation_Last_message"=> $conversation->lastMessage->body=='Message deleted'?$conversation->lastMessage->body:
                [
                "Last_message_Id"=>$conversation->lastMessage->id,
                "Last_message_Type"=>$conversation->lastMessage->type,
                "Last_message_Body"=>$conversation->lastMessage->body,
                "Last_message_Sender"=> $conversation->lastMessage->sender->name,
            ],
        ];
    }
}
