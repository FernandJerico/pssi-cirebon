<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminOfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.officials.index', [
            "title" => "Officials",
            "officials" => Official::get(),
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
        return view('dashboard.officials.create',[
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
            'slug' => 'required|unique:officials',
            'position' => 'required',
            'status' => 'required',
            'image' => 'image|file|max:5120',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('officials-image');
        }

        Official::create($validatedData);

        alert()->success('Officials Successful Added!', 'Success');
        return redirect('dashboard/officials');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Official $official)
    {
        return view('dashboard.officials.show',[
            'officials' => $official,
            'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Official $official)
    {
        return view('dashboard.officials.edit',[
            'officials' => $official,
            'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Official $official)
    {
        $rules = [
            'name' => 'required|max:255',
            'position' => 'required',
            'status' => 'required',
            'image' => 'image|file|max:5120',
        ];

        if($request->slug != $official->slug){
            $rules['slug'] = 'required|unique:officials';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('officials-image');
        }

        Official::where('id', $official->id)->update($validatedData);

        alert()->success('Data Successful Updated!', 'Success');
        return redirect('dashboard/officials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Official $official)
    {
        Official::destroy($official->id);

        alert()->success('Data Successful Deleted!', 'Success');
        return redirect('dashboard/officials');
    }
}