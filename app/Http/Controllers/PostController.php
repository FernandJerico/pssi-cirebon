<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Team;
use PhpParser\Node\Expr\FuncCall;

class PostController extends Controller
{
    public function index()
    {
        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name; 
        }

        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }

        $posts = Post::latest()->filter(request(['search', 'category', 'author']))->where('is_approved', 1)->paginate(9);

        return view('posts', [
            "title" => "All News" . $title,
            "categories" => Category::all(),
            "posts" => $posts,
            "list_teams" => Team::get()
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            "title" => "Detail News",
            "post" => $post,
            "categories" => Category::get(),
            "list_teams" => Team::get()
        ]);
    }
}