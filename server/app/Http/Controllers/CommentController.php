<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Exception;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate(['text' => 'required|max:500']);
        $userId = $request->cookie('userId');
        $text = $request->text;
        try {
            Comment::create(compact('userId', 'postId', 'text'));
        } catch (Exception $exception) {
            dd($exception);
        }
        return redirect()->route('post.show', $postId);
    }
}
