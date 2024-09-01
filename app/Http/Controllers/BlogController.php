<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function index(Request $request, Post $post)
    {
        $data = $request->all();
        $post = Post::latest()->paginate(10);
        $comments = [];
        
        return view('blogs.index', ['post' => $post]);
    }
    public function show(Post $blog)
    {
        return view('post.show', compact('post'));
    }

}