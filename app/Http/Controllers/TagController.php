<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view('tags.index', compact('tags'));
    }


    public function create(Post $post_id)
    {
        $tag = new Tag();
        return view('tags.create', compact('tag'));
    }


    public function store(Request $request, Post  $post)
    {


        $tag = Tag::create([

            'tag_name' => $request->tag_name
        ]);

//        $post->tags()->attach($tag->id);
        $tag->posts()->attach($post->id);



        return redirect()->route('tag.index');


    }


    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tag.index');


    }
    public function show($id)
    {
        // Find the tag with the given id
        $tag = Tag::findOrFail($id);

        // Return the view with the tag data
        return view('tags.show', compact('tag'));
    }

}
