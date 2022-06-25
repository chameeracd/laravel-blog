<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id'];

    public function getUserPosts() {
        return BlogPost::where('user_id', '=', Auth::id())->get();
    }
    

}
