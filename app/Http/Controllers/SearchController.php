<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $query = $request->input('query');
        if (!$query) {
            return view('search');
        }
        $users = User::where('name', 'like', '%' . $query . '%')->get();
        return view('search', compact('users', 'query'));
    }
}
