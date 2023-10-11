<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminCategoryNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('is_admin');
        return view('dashboard.categories-news.index', [
            'categories' => Category::all(),
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
        return view('dashboard.categories-news.create',[
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories',
        ]);

        Category::create($validatedData);

        alert()->success('Category Successful Added!', 'Success');
        return redirect('dashboard/categories-news');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categories_news)
    {
        return view('dashboard.categories-news.edit',[
            'news' => $categories_news,
            'categories' => Category::all(),
            'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $categories_news)
    {
        $rules = [
            'name' => 'required|max:255',
        ];
        
        if($request->slug != $categories_news->slug){
            $rules['slug'] = 'required|unique:categories';
        }

        $validatedData = $request->validate($rules);
        Category::where('id', $categories_news->id)->update($validatedData);

        alert()->success('Category Successful Updated!', 'Success');
        return redirect('dashboard/categories-news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $categories_news)
    {
        Category::destroy($categories_news->id);

        alert()->success('Category Successful Deleted!', 'Success');
        return redirect('dashboard/categories-news');
    }
}