<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Player;
use App\Models\Team;
use App\Models\Coach;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('is_admin');
        return view('dashboard.teams.index', [
            'teams' => Team::get(),
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
        return view('dashboard.teams.create',[
            'categories' => Category::get(),
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
            'team_name' => 'required|max:255',
            'slug' => 'required|unique:teams',
            'category_id' => 'required',
            'image' => 'image|file|max:5120',
            'description' => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('team-image');
        }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 50);
        Team::create($validatedData);

        alert()->success('Team Successful Added!', 'Success');
        return redirect('dashboard/teams');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return view('dashboard.teams.show',[
            'teams' => $team,
            'players' => Player::where('team_id', $team->id)->get(),
            'coaches' => Coach::where('team_id', $team->id)->get(),
            'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('dashboard.teams.edit',[
            'teams' => $team,
            'categories' => Category::all(),
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
    public function update(Request $request, Team $team)
    {
        $rules = [
            'team_name' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:5120',
            'description' => 'required'
        ];

        if($request->slug != $team->slug){
            $rules['slug'] = 'required|unique:teams';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('news-image');
        }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 50);
        
        Team::where('id', $team->id)->update($validatedData);

        alert()->success('Team Successful Updated!', 'Success');
        return redirect('dashboard/teams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        if($team->image){
            Storage::delete($team->image);
        }
        Team::destroy($team->id);

        alert()->success('Team Successful Deleted!', 'Success');
        return redirect('dashboard/teams');
    }
}