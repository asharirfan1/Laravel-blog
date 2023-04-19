<?php

namespace App\Http\Controllers;

use App\Mail\CommentMail;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

//use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment = Comment::all();
        return view('post.allComments', compact('comment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $comment)
    {

        $data = request()->validate([
            'comment' => 'required|string|max:255',
        ]);

        $comment = Comment::create([
            'user_id'=>Auth::user()->id,
            'post_id'=>$comment,
            'comment'=>$request->comment,
        ]);
        $postOwner = $comment->post->user;


//        Mail::to($request->user())->send(new CommentMail($comment));
        Mail::to($postOwner->email)->send(new CommentMail($comment));


        return redirect('all');

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'comment' => $request->comment,
        ]);
        return redirect()->route("Comment.index");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('Comment.index');

    }
}
