<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): RedirectResponse
    {
        $data = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);
        $data['user_id'] = auth()->id();
        $data['post_id'] = $post->id;

        Comment::query()->create($data);

        return redirect()->route('posts.show', $post)->with('success', 'Your comment has been posted!');
    }

    public function delete(Post $post, Comment $comment): RedirectResponse
    {
        if ($comment->post_id !== $post->id) {
            abort(404);
        }

        if ($comment->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $comment->delete();
        return redirect()->back()->with('error', 'Comment has been deleted!');
    }
}
