<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //$this->load('user');
        return [
            'user' => $this->user,
            'id' => $this->id,
            'title' =>$this->title,
            'created_at' => $this->created_at->diffForHumans(),
            'relationship' => [
                 'Images' => $this->images->map(function($item){
                    return ([
                        asset($item->image),
                    ]);
                 }),
            ],
        ];
    }
}
