<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use Exception;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function add(Request $request, $friend_id)
    {
        $user_id = $request->cookie('user_id');
        Friend::create([
            'user_id' => $user_id,
            'friend_id' => $friend_id,
            'confirmed' => 0
        ]);
        return redirect()->back();
    }

    public function show_friend_requests(Request $request)
    {
        $user_id = $request->cookie('user_id');
        $requesters = DB::select(
            DB::raw(
                'select id, name
                from friends
                inner join users on users.id = friends.user_id
                where confirmed = 0
                and friend_id = :user_id'
            ),
            compact('user_id')
        );
        return view('friend-requests', compact('requesters'));
    }

    public function confirm(Request $request, $friend_id)
    {
        $user_id = $request->cookie('user_id');
        // Should swap the IDs because friend is the one who send the request
        Friend::where('user_id', $friend_id)
            ->where('friend_id', $user_id)
            ->update(['confirmed' => 1]);
        return redirect()->back();
    }

    public function delete(Request $request, $friend_id)
    {
        $user_id = $request->cookie('user_id');
        Friend::where('user_id', $user_id)
            ->where('friend_id', $friend_id)
            ->delete();
        return redirect()->back();
    }
}
