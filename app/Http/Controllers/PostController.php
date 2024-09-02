<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
     $items = Post::where('user_id', auth()->user()->id)->paginate(10)->onEachSide(2);
     return view("post.index",['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */     
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|mime_types:image/*'
        ]);
        $validate['user_id'] = Auth::user()->id;
        if($request->file("image")){
            $file = $request->file('image');
            $filename = uniqid().time().str_replace(" ","_",$file->getClientOriginalName());
            $file->move(public_path().'/images/post', $filename);
            $validate['image'] = $filename;
        }
        Post::create($validate);
        return redirect()->route('post.index')->with("success","Post added");

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
     return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
return view('post.update', ['post' => $post]);
        //...
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validate = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|mime_types:image/*'
        ]);
        $validate['user_id'] = Auth::user()->id;
        if($request->file("image")){
            $file = $request->file('image');
            $filename = uniqid().time().str_replace(" ","_",$file->getClientOriginalName());
            $file->move(public_path().'/images/post', $filename);
            $validate['image'] = $filename;
        }
        $post->title = $validate['title'];
        $post->content = $validate['content'];
        $post->image = $validate['image'];
        $post->user_id = $validate['user_id'];
        $post->save();
        return redirect()->route('post.index')->with("success","Post updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //$this->authorize('delete', $post);
        if($this->isOwner($post)){
            $post->delete();
            return redirect()->route('post.index')->with("success","Post deleted");
        } else {
             throw new Exception("Unauthorized access");
        }
        
        
    }

    function isOwner(Post $post){
        if(auth()->user()->id == $post->user_id){
            return true;
        } else {
            return false;
        }
    }   
}
