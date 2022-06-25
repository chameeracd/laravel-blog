<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blog = new BlogPost();
        $posts = $blog->getUserPosts();
	    return view('home', [
            'posts' => $posts,
        ]);
    }
}
