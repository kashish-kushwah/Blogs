<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','user_id','title','content','image'];

    public function comment(){
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}   
