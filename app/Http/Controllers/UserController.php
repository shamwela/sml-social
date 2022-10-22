<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\LikeController;
use App\Models\Comment;
use App\Models\Friend;
use App\Models\FriendRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        $user_id = $request->cookie('user_id');
        foreach ($users as $user) {
            $other_user_id = $user->id;
            // Check if friends
            // Query builder would return an array no matter how many record it gets
            $friend_array = Friend::where('user_id', $user_id)
                // the other user
                ->where('friend_id', $other_user_id)
                ->get();

            $friend_request_array = FriendRequest::where('requester_id', $user_id)
                ->where('receiver_id', $other_user_id)
                ->get();

            // If neither friends nor requested
            if ($friend_array->isEmpty() and $friend_request_array->isEmpty()) {
                $user->status = 'stranger';
            } elseif ($friend_array->isNotEmpty()) {
                $user->status = 'friend';
            } else {
                $user->status = 'requested';
            }
        }

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = $id;
        $user = User::find($user_id);
        $posts = Post::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($posts as $post) {
            $post->user_name = $user->name;
            app(LikeController::class)->add_like_data($post, $user_id);
            $post->comment_count = count(Comment::where('post_id', $post->id)->get());

            // Since profile_picture_url will be accessed on post
            $post->profile_picture_url = $user->profile_picture_url;
        }
        return view('user.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_profile_picture(Request $request)
    {
        $user_id = $request->cookie('user_id');
        $request->validate(
            ['profile_picture' => 'required']
        );
        $result = $request->profile_picture->storeOnCloudinary('SML Social');
        $image_url = $result->getSecurePath();
        $user = User::find($user_id);
        $user->profile_picture_url = $image_url;
        $user->save();
        return redirect()->back();
    }
}
