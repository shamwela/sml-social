<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedPost;
use Exception;
use Illuminate\Support\Facades\DB;

class SavedPostController extends Controller
{
    public function save(Request $request, $postId)
    {
        $userId = $request->cookie('userId');
        try {
            SavedPost::create([
                'userId' => $userId,
                'postId' => $postId
            ]);
        } catch (Exception $exception) {
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function index(Request $request)
    {
        $userId = $request->cookie('userId');
        $savedPosts = [];
        try {
            $savedPosts = DB::select(
                // Join savedPosts, posts, and users tables
                // Input user ID is current user ID
                // Output user ID is post owner ID
                DB::raw('
                    select users.id as userId, users.name as userName, posts.id, posts.text, posts.imageUrl
                    from savedPosts
                    inner join posts on savedPosts.postId = posts.id
                    inner join users on posts.userId = users.id
                    where savedPosts.userId = :userId
                '),
                array('userId' => $userId)
            );
        } catch (Exception $exception) {
            dd($exception);
        }
        return view('saved-posts.index', compact('savedPosts'));
    }

    public function destroy(Request $request, $postId)
    {
        $userId = $request->cookie('userId');
        try {
            SavedPost
                ::where('userId', $userId)
                ->where('postId', $postId)
                ->delete();
        } catch (Exception $exception) {
            dd($exception);
        }
        return redirect()->route('saved-posts.index');
    }
}
