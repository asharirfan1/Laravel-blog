<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

        class PostController extends Controller
        {
            /**
             * Display a listing of the resource.
             */

            public function index(Request $request)
            {
                $search = $request['search'] ?? '';
                if ($search != '') {
                    //where
                    $posts = Post::where('title', 'like', "%$search%")->get();
                } else {
                    $posts = Post::where('user_id', auth()->user()->id)->get();
                }


                return view('post.index', compact('posts'));
            }


            /**
             * Show the form for creating a new resource.
             */
            public function create(Post $post_id)
            {


                $post = new Post();
                $post->user_id = auth()->user()->id;
                $tags = Tag::all();

                return view('post.create', compact('post', 'tags'));


            }

            /**
             * Store a newly created resource in storage.
             */

            public function store(Request $request)
            {

                if ($request->hasFile('image')) {
                    $image_path = $this->storeImage($request);
                }

                $post = Post::create([
                    'title' => $request->title,
                    'content' => $request->content,
                    'user_id' => auth()->user()->id,
                    'image_path' => $image_path ?? null,
                ]);

                $tagId = $request->input('tags'); // assuming the form input name is 'tag_id'
                $post->tags()->attach($tagId);

                return redirect()->route("post.index");
            }



            /**
             * Display the specified resource.
             */
            public function show(Post $post)
            {

            }

            /**
             * Show the form for editing the specified resource.
             */
            public function edit(Post $post)
            {
                return view('post.edit', compact('post'));
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

            public function storeImage($request)
            {

                $newImage = uniqid() . '-' . $request->title . '.' . $request->image->extension();

                $request->image->move(public_path('images'), $newImage);

                return $newImage;

            }


        }
