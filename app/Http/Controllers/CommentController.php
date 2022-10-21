<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Exception;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $request->validate(['text' => 'required|max:500']);
        $user_id = $request->cookie('user_id');
        $text = $request->text;
        try {
            Comment::create(compact('user_id', 'post_id', 'text'));
        } catch (Exception $exception) {
            dd($exception);
        }
        return redirect()->route('post.show', $post_id);
    }
}
