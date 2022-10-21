<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Exception;

class LikeController extends Controller
{
    public function like(Request $request, $postId)
    {
        $userId = $request->cookie('userId');
        try {
            Like::create(compact('userId', 'postId'));
        } catch (Exception $exception) {
            return redirect()->route('post.show', $postId);
        }
        return redirect()->route('post.show', $postId);
    }

    public function unlike(Request $request, $postId)
    {
        $userId = $request->cookie('userId');
        try {
            Like::where('userId', $userId)
                ->where('postId', $postId)
                ->delete();
        } catch (Exception $exception) {
            return redirect()->route('post.show', $postId);
        }
        return redirect()->route('post.show', $postId);
    }

    public function addLikeData($post, $userId)
    {
        // Check if the current user has liked it
        $isLiked = Like::where('postId', $post->id)
            ->where('userId', $userId)
            ->get()
            ->isNotEmpty();
        $post->isLiked = $isLiked;

        $likeCount = Like::where('postId', $post->id)->count();
        $post->likeCount = $likeCount;
    }
}
