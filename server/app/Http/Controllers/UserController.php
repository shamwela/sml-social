<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\FriendUser;
use Exception;
use App\Http\Controllers\LikeController;
use App\Models\Comment;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
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
        $userId = $id;
        $user = User::find($userId);
        $posts = Post::where('userId', $id)->get();
        foreach ($posts as $post) {
            $post->userName = $user->name;
            app(LikeController::class)->addLikeData($post, $userId);
            $post->commentCount = count(Comment::where('postId', $post->id)->get());
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

    public function add_friend(Request $request, $friendId)
    {
        $userId = $request->cookie('userId');
        try {
            FriendUser::insert([
                [
                    'userId' => $userId,
                    'friendId' => $friendId,
                ],
                [
                    // Also save the other way
                    // Because this takes more storage, improve later
                    'userId' => $friendId,
                    'friendId' => $userId,
                ],
            ]);
        } catch (Exception $exception) {
            return redirect()->route('user.index');
        }
        return redirect()->route('user.index');
    }

    public function update_profilePicture(Request $request)
    {
        $userId = $request->cookie('userId');
        $request->validate(
            ['profilePicture' => 'required']
        );
        $result = $request->profilePicture->storeOnCloudinary('SML Social');
        $imageUrl = $result->getSecurePath();
        $user = User::find($userId);
        $user->profilePictureUrl = $imageUrl;
        $user->save();
        return redirect()->back();
    }
}
