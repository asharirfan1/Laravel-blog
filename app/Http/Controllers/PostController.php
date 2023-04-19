<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//use Traits\ImageUpload;

class PostController extends Controller
{
    use ImageUpload;


    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $search = $request['search'] ?? '';

        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();
//               $fromDate = false;
//               $toDate = false;
        $category = $request->category_id;
        $tag = $request->tag_id;

        $posts = Post::query()
            ->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orwhere('content', 'like', "%$search%")
                    ->orWhereHas('tags', function ($query) use ($search) {
                        $query->where('tag_name', 'like', "%$search%");
                    });
            })
            ->when($category, function ($q) use ($category) {
                $q->whereHas('categories', function ($q) use ($category) {
                    $q->whereIn('id', $category);
                });
            })
            ->when($tag, function ($q) use ($tag) {
                $q->whereHas('tags', function ($q) use ($tag) {
                    $q->where('id', $tag);
                });
            })
            ->get();


        return view('post.index', compact('posts', 'categories', 'tags'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post_id)
    {


        $post = new Post();
        $post->user_id = auth()->user()->id;
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.create', compact('post', 'tags', 'categories'));


    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        if ($request->hasFile('image')) {
            $image_path = $this->storeImage($request);   //store image is coming from traits
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'image_path' => $image_path ?? null,
        ]);


        $tagId = $request->input('tags'); // assuming the form input name is 'tag_id'
        $post->tags()->attach($tagId);

        $post->categories()->attach($request->category);        //ataching to pivot table


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
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.edit', compact('post', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $posts = Post::all();
        $tags = Tag::all();
        $categories = Category::all();

        // Get the previous image path
        $old_image = $post->image_path;

        if ($request->hasFile('image')) {

            // Deleting old file

            Storage::disk()->delete('public/images/'.($old_image));


            // Store the new image
            $image_path = $this->storeImage($request);
        }

        else

        {
            // No new image, keep the previous one
            $image_path = $old_image;
        }


        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'tag_name' => $request->tag_name,
            'category' => $request->name,
            'image_path' => $image_path,


        ]);
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    /*    public function storeImage($request)
        {

            $newImage = uniqid() . '-' . $request->title . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $newImage);

            return $newImage;


        }*/


}
