<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
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
        $post = new Post;
        $post->text = $request->text;
        $post->user_id = $request->user_id;
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
        $post = new Post;
        $post->text = $request->text;
        $post->user_id = $request->user_id;
        // If database image name and client image name are different, it's a new image
        if ($post->image_name !== $request->image->getClientOriginalName()) {
            $old_image_path = public_path() . '/images/' . $post->image_name;
            // Delete old image
            unlink($old_image_path);

            // To store the new image
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
    }
}
