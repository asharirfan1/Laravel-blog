<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class allController extends Controller
{
    public function index(Request $request)
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

        $posts = Post::all();
        return view('Post.all', compact('posts'));
    }

}
