<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedPost;
use Exception;
use Illuminate\Support\Facades\DB;

class SavedPostController extends Controller
{
    public function save(Request $request, $post_id)
    {
        $user_id = $request->cookie('user_id');
        try {
            SavedPost::create([
                'user_id' => $user_id,
                'post_id' => $post_id
            ]);
        } catch (Exception $exception) {
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function index(Request $request)
    {
        $user_id = $request->cookie('user_id');
        $saved_posts = [];
        try {
            $saved_posts = DB::select(
                // Join saved_posts, posts, and users tables
                // Input user ID is current user ID
                // Output user ID is post owner ID
                DB::raw('
                    select users.id as user_id, users.name as user_name, posts.id, posts.text, posts.image_name
                    from saved_posts
                    inner join posts on saved_posts.post_id = posts.id
                    inner join users on posts.user_id = users.id
                    where saved_posts.user_id = :user_id
                '),
                array('user_id' => $user_id)
            );
        } catch (Exception $exception) {
            dd($exception);
        }
        return view('saved-posts.index', compact('saved_posts'));
    }

    public function destroy(Request $request, $post_id)
    {
        $user_id = $request->cookie('user_id');
        try {
            SavedPost
                ::where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->delete();
        } catch (Exception $exception) {
            dd($exception);
        }
        return redirect()->route('saved-posts.index');
    }
}
