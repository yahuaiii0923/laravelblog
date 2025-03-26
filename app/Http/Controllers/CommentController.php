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

    public function destroy(Comment $comment)
        {
            // Authorization check
            if (auth()->user()->id !== $comment->user_id) {
                abort(403, 'Unauthorized action');
            }

            $comment->delete();

            return back()->with('success', 'Comment deleted successfully');
        }

    public function toggleLike(Comment $comment)
    {
        $user = Auth::user();

        $like = $comment->likes()
                       ->where('user_id', $user->id)
                       ->first();

        if ($like) {
            $like->delete();
            $message = 'Like removed';
        } else {
            //using fillable fields
            $comment->likes()->create([
                'user_id' => $user->id,
                'comment_id' => $comment->id
            ]);
            $message = 'Comment liked!';
        }

        return with('success', $message);
    }
}
