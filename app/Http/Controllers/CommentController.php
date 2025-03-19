<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        // validate comments content
        $request->validate([
            'content' => 'required|string|max:500'
        ]);

        // search corresponding postId
        $post = Post::findOrFail($postId);

        // create comment
        $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success');
    }
}
