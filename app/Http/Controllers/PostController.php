<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function show_friend_posts(Request $request)
    {
        $user_id = $request->cookie('user_id');
        $posts = DB::select(
            // Select the user's friends' posts
            DB::raw(
                'select posts.id, text, image_name, posts.user_id, name as user_name from posts 
                inner join friend_users on friend_users.friend_id = posts.user_id
                inner join users on users.id = posts.user_id
                where friend_users.user_id = :user_id'
            ),
            array('user_id' => $user_id)
        );
        return view('home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['text' => 'required|max:500']);
        $post = new Post;
        $post->text = $request->text;
        $post->user_id = $request->cookie('user_id');
        if ($request->hasFile('image')) {
            $image = $request->image;
            // Make the image name unique by adding year, month, date, hour and minute.
            $image_name = date('YmdHi') . $image->getClientOriginalName();
            // Store in the file system
            $image->move(public_path() . '/images/', $image_name);
            // Store in the database
            $post->image_name = $image_name;
        }
        $post->save();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->text = $request->text;
        $post->save();
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('home');
    }
}
