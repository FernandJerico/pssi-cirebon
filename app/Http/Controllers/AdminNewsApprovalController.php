<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminNewsApprovalController extends Controller
{
    public function index()
    {
        $this->authorize('is_admin');
        return view('dashboard.need-approval.index', [
            'unapprovedNews' => Post::where('is_approved', 0)->get(),
            'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
            'countArchivedPosts' => Post::where('is_approved', 2)->count(),
        ]);
    }

    public function approvePost($id)
    {
        $post = Post::findOrFail($id);
        $post->is_approved = 1;
        $post->save();

        alert()->success('News Successful Approved!', 'Success');
        return redirect('dashboard/need-approval/');
    }

    public function archivePost($id)
    {
        $post = Post::findOrFail($id);
        $post->is_approved = 2;
        $post->save();

        alert()->success('News Successful Archived!', 'Success');
        return redirect('dashboard/need-approval/');
    }
}