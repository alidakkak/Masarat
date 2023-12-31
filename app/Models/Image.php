<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setImageAttribute ($image){
        $newImageName = uniqid() . '_' . 'post_image' . '.' . $image->extension();
        $image->move(public_path('post_image') , $newImageName);
        return $this->attributes['image'] =  '/'.'post_image'.'/' . $newImageName;
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
}
