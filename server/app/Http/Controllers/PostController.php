<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\LikeController;
use App\Models\Comment;

class PostController extends Controller
{
    public function getFriendPosts(Request $request)
    {
        if (!isLoggedIn($request)) {
            // Return error here later
            return;
        }
        $userId = $request->userId;
        $posts = DB::select(
            DB::raw(
                'select posts.id, text, imageUrl, posts.userId, name as userName
                from posts

                -- Only select friend posts, not all posts
                inner join friendUsers on friendUsers.friendId = posts.userId

                -- Also join with users table to get names
                inner join users on users.id = posts.userId

                where friendUsers.userId = :userId'
            ),
            // Give input like this to prevent SQL injection
            compact('userId')
        );

        foreach ($posts as $post) {
            app(LikeController::class)->addLikeData($post, $userId);

            $post->commentCount = count(Comment::where('postId', $post->id)->get());
        }

        return response($posts);
    }

    public function store(Request $request)
    {
        $request->validate(['text' => 'required|max:500']);
        $post = new Post;
        $post->text = $request->text;
        $post->userId = $request->cookie('userId');
        if ($request->hasFile('image')) {
            $result = $request->image->storeOnCloudinary('SML Social');
            $imageUrl = $result->getSecurePath();
            $post->imageUrl = $imageUrl;
        }
        $post->save();
        return redirect()->route('home');
    }

    public function show(Request $request, $id)
    {
        $postId = $id;
        $posts = DB::select(
            DB::raw(
                'select posts.id, text, imageUrl, posts.userId, name as userName
                from posts

                -- join with users table to get names
                inner join users on users.id = posts.userId

                where posts.id = :postId'
            ),
            // Give input like this to prevent SQL injection
            compact('postId')
        );

        // Since the post ID is unique, there'll be only one post
        $post = $posts[0];
        $userId = $request->cookie('userId');
        app(LikeController::class)->addLikeData($post, $userId);

        $comments = DB::select(
            DB::raw(
                'select users.name as commentatorName, users.id as commentatorId, text
                from comments
                inner join users on users.id = comments.userId
                where comments.postId = :postId
                order by comments.created_at desc'
            ),
            compact('postId')
        );
        $post->commentCount = count($comments);

        return view('post.show', compact('post', 'comments'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->text = $request->text;
        $post->save();
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('home');
    }
}
