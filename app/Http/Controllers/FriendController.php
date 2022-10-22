<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use Illuminate\Support\Facades\DB;
use App\Models\FriendRequest;

class FriendController extends Controller
{
    public function add(Request $request, $friend_id)
    {
        $user_id = $request->cookie('user_id');
        FriendRequest::create([
            'requester_id' => $user_id,
            'receiver_id' => $friend_id
        ]);
        return redirect()->back();
    }

    public function show_friend_requests(Request $request)
    {
        $user_id = $request->cookie('user_id');
        $requesters = DB::select(
            DB::raw(
                'select id, name
                from friend_requests
                inner join users on friend_requests.requester_id = users.id
                where receiver_id = :user_id'
            ),
            compact('user_id')
        );
        return view('friend-requests', compact('requesters'));
    }

    public function confirm(Request $request, $friend_id)
    {
        $user_id = $request->cookie('user_id');

        FriendRequest::where('requester_id', $friend_id)
            ->where('receiver_id', $user_id)
            ->delete();

        Friend::insert([
            [
                'user_id' => $user_id,
                'friend_id' => $friend_id
            ],
            // Also save the other way
            [
                'user_id' => $friend_id,
                'friend_id' => $user_id
            ]
        ]);

        return redirect()->back();
    }

    public function delete(Request $request, $friend_id)
    {
        $user_id = $request->cookie('user_id');
        FriendRequest::where('requester_id', $user_id)
            ->where('receiver_id', $friend_id)
            ->delete();
        // Also delete the other way
        FriendRequest::where('requester_id', $friend_id)
            ->where('receiver_id', $user_id)
            ->delete();
        return redirect()->back();
    }
}
