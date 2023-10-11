<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.news.index', [
            'news' => Post::where('user_id', auth()->user()->id)->get(),
            'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.news.create',[
            'categories' => Category::all(),
            'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'slug' => 'required|unique:posts',
                'category_id' => 'required',
                'image' => 'image|file|max:5120',
                'body' => 'required',
                'is_approved' => 'boolean',
            ]);
    
            if($request->file('image')){
                $validatedData['image'] = $request->file('image')->store('news-image');
            }
    
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['is_approved'] = auth()->user()->is_admin ? 1 : 0;
            $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
            Post::create($validatedData);
    
            alert()->success('News Successful Added!', 'Success');
            return redirect('dashboard/news');
        } catch (Exception $e) {
            dd($e);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $news)
    {
        if (auth()->user()->is_admin) {
            // Jika user adalah is_admin, izinkan akses ke post
            return view('dashboard.news.show', [
                'news' => $news,
                'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
            ]);
        } else {
            // Jika user bukan is_admin, periksa apakah post dibuat oleh user itu sendiri
            if ($news->author->id !== auth()->user()->id) {
                // Jika post dibuat oleh orang lain, abort dengan error 403 (Forbidden)
                abort(403);
            }
            // Jika post dibuat oleh user itu sendiri, izinkan akses
            return view('dashboard.news.show', [
                'news' => $news,
                'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $news)
    {
        return view('dashboard.news.edit',[
            'news' => $news,
            'categories' => Category::all(),
            'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $news)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:5120',
            'body' => 'required',
            'is_approved' => 'boolean',
        ];

        if($request->slug != $news->slug){
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('news-image');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        
        Post::where('id', $news->id)->update($validatedData);

        if($news->author->id !== auth()->user()->id){
            abort(403);
        }

        alert()->success('News Successful Updated!', 'Success');
        return redirect('dashboard/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $news)
    {
        if($news->image){
            Storage::delete($news->image);
        }
        Post::destroy($news->id);

        alert()->success('News Successful Deleted!', 'Success');
        return redirect('dashboard/news');
    }
}