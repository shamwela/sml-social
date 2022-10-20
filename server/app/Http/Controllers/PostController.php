<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\LikeController;
use App\Models\Comment;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    public function get_friend_posts(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        $user_id  = $user->id;
        if (!$user) {
            // return error
            return;
        }
        if (!Hash::check($password, $user->password)) {
            // Wrong password
            return;
        }
        $posts = DB::select(
            DB::raw(
                'select posts.id, text, image_url, posts.user_id, name as user_name
                from posts

                -- Only select friend posts, not all posts
                inner join friend_users on friend_users.friend_id = posts.user_id

                -- Also join with users table to get names
                inner join users on users.id = posts.user_id

                where friend_users.user_id = :user_id'
            ),
            // Give input like this to prevent SQL injection
            compact('user_id')
        );

        foreach ($posts as $post) {
            app(LikeController::class)->add_like_data($post, $user_id);

            $post->comment_count = count(Comment::where('post_id', $post->id)->get());
        }

        return response($posts);
    }

    public function store(Request $request)
    {
        $request->validate(['text' => 'required|max:500']);
        $post = new Post;
        $post->text = $request->text;
        $post->user_id = $request->cookie('user_id');
        if ($request->hasFile('image')) {
            $result = $request->image->storeOnCloudinary('SML Social');
            $image_url = $result->getSecurePath();
            $post->image_url = $image_url;
        }
        $post->save();
        return redirect()->route('home');
    }

    public function show(Request $request, $id)
    {
        $post_id = $id;
        $posts = DB::select(
            DB::raw(
                'select posts.id, text, image_url, posts.user_id, name as user_name
                from posts

                -- join with users table to get names
                inner join users on users.id = posts.user_id

                where posts.id = :post_id'
            ),
            // Give input like this to prevent SQL injection
            compact('post_id')
        );

        // Since the post ID is unique, there'll be only one post
        $post = $posts[0];
        $user_id = $request->cookie('user_id');
        app(LikeController::class)->add_like_data($post, $user_id);

        $comments = DB::select(
            DB::raw(
                'select users.name as commentator_name, users.id as commentator_id, text
                from comments
                inner join users on users.id = comments.user_id
                where comments.post_id = :post_id
                order by comments.created_at desc'
            ),
            compact('post_id')
        );
        $post->comment_count = count($comments);

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
