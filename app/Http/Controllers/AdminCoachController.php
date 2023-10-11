<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use App\Models\Team;
use App\Models\Post;

class AdminCoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('is_admin');
        return view('dashboard.coaches.index', [
            'coaches' => Coach::get(),
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
        return view('dashboard.coaches.create',[
            'teams' => Team::get(),
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
            'slug' => 'required|unique:teams',
            'team_id' => 'required',
            'position' => 'required',
            'phone_number' => 'required'
        ]);

        Coach::create($validatedData);

        alert()->success('Coach Successful Added!', 'Success');
        return redirect('dashboard/coaches');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coach $coach)
    {
        return view('dashboard.coaches.edit',[
            'coaches' => $coach,
            'teams' => Team::get(),
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
    public function update(Request $request, Coach $coach)
    {
        $rules = [
            'name' => 'required|max:255',
            'team_id' => 'required',
            'position' => 'required',
            'phone_number' => 'required',
        ];

        if($request->slug != $coach->slug){
            $rules['slug'] = 'required|unique:coaches';
        }

        $validatedData = $request->validate($rules);
        
        Coach::where('id', $coach->id)->update($validatedData);

        alert()->success('Coach Successful Updated!', 'Success');
        return redirect('dashboard/coaches');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coach $coach)
    {
        Coach::destroy($coach->id);

        alert()->success('Coach Successful Deleted!', 'Success');
        return redirect('dashboard/coaches');
    }
}