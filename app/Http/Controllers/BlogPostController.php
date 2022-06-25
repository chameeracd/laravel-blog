<?php
namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BlogPostController extends Controller
{
    
    public function index()
    {
        $posts = BlogPost::all();
	    return view('blog.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('blog.create');
    }

   
    public function store(Request $request)
    {
        $newPost = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id()
        ]);

        return redirect('blog/' . $newPost->id);
    }

    public function show(BlogPost $blogPost)
    {
        return view('blog.show', [
            'post' => $blogPost,
        ]);
    }

    
    public function edit(BlogPost $blogPost)
    {
        if (! Gate::allows('own-post', $blogPost)) {
            abort(403);
        }
        return view('blog.edit', [
            'post' => $blogPost,
        ]);
    }

    
    public function update(Request $request, BlogPost $blogPost)
    {
        if (! Gate::allows('own-post', $blogPost)) {
            abort(403);
        }

        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect('blog/' . $blogPost->id);
    }

    
    public function destroy(BlogPost $blogPost)
    {
        if (! Gate::allows('own-post', $blogPost)) {
            abort(403);
        }
        
        $blogPost->delete();

        return redirect('/blog');
    }
}