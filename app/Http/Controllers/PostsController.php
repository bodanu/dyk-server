<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostsController extends Controller
{
    public function index()
    {
        return response()->json(Posts::withCount('comments', 'likers')->orderBy('created_at', 'desc')->get()->toArray());
    }

    public function create(Request $request)
    {
        $newPost = Posts::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'body' => $request->body
        ]);

        return response()->json($newPost);
    }

    public function show($id)
    {
        // Log::info($id);
        $post = Posts::with('comments.user')->find($id);
        return response()->json($post);
    }

    public function comment(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $post = Posts::find($request->get('post_id'));
        $post->comments()->save($comment);

        return response()->json($comment);
    }

    public function like(Request $request)
    {
        $user = Auth::user();
        $post = Posts::find($request->get('post_id'));
        $user->toggleLike($post);
    }

    public function userPosts()
    {
        $posts = Auth::user()->posts()->withCount('comments', 'likers')->orderBy('created_at', 'desc')->get()->toArray();
        return response()->json($posts);
    }
}
