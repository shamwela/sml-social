<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Exception;

class LikeController extends Controller
{
    public function like(Request $request, $post_id)
    {
        $user_id = $request->cookie('user_id');
        try {
            Like::create(compact('user_id', 'post_id'));
        } catch (Exception $exception) {
            return redirect()->route('post.show', $post_id);
        }
        return redirect()->route('post.show', $post_id);
    }

    public function unlike(Request $request, $post_id)
    {
        $user_id = $request->cookie('user_id');
        try {
            Like::where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->delete();
        } catch (Exception $exception) {
            return redirect()->route('post.show', $post_id);
        }
        return redirect()->route('post.show', $post_id);
    }

    public function add_like_data($post, $user_id)
    {
        // Check if the current user has liked it
        $is_liked = Like::where('post_id', $post->id)
            ->where('user_id', $user_id)
            ->get()
            ->isNotEmpty();
        $post->is_liked = $is_liked;

        $like_count = Like::where('post_id', $post->id)->count();
        $post->like_count = $like_count;
    }
}
