<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Random\Engine\Mt19937;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index( Request $request)
    {
        $search = $request['search'] ?? '';
        if($search != '')
        {
            //where
            $posts = Post::where('title' , 'like' , "%$search%")->get();
        }
        else
        {
            $posts = Post::where('user_id', auth()->user()->id)->get();
        }


        return view('Post.index', compact('posts'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = new Post();
        $post->user_id = auth()->user()->id;

        return view('Post.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id,

        ]);


        return redirect()->route("post.index");
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('Post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $post->update([
            'title' => $request->title,
            'content' => $request->content

        ]);
        return redirect()->route("post.index")->with('success', 'post updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
