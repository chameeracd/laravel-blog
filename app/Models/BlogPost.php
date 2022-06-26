<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id'];

    public function getUserPosts() {
        return BlogPost::where('user_id', '=', Auth::id())->get();
    }
    
    /**
     * Get the use that owns the blog post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
