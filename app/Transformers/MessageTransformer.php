<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class MessageTransformer extends TransformerAbstract
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
    public function transform($message)
    {
        return [
            "Message_Id"=>$message->id,
            "Message_Type"=>$message->type,
            "Message_Body"=>$message->body,
            "Message_Created_at"=>$message->created_at->format('Y-m-d H:i:s'),
            "Message_Sender_Id"=>$message->sender->id,
            "Message_Sender_Name"=>$message->sender->name,
        ];
    }
}
