<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminNewsArchivedController extends Controller
{
    public function index()
    {
        $this->authorize('is_admin');
        return view('dashboard.archived-news.index', [
            'archivedNews' => Post::where('is_approved', 2)->get(),
            'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
            'countArchivedPosts' => Post::where('is_approved', 2)->count(),
        ]);
    }
}