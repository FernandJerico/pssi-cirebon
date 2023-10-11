<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Post;
use App\Models\Player;

class AdminPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        return view('dashboard.teams.players.create',[
            'team_id' => Team::where('id',$team->id)->get(),
            'teams' => $team,
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
            'place_birthdate' => 'required',
            'gender' => 'required',
            'position' => 'required',
            'status' => 'required',
        ]);

        Player::create($validatedData);

        alert()->success('Player Successful Added!', 'Success');
        return redirect('dashboard/teams');
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
    public function edit(Team $team, Player $player)
    {
        return view('dashboard.teams.players.edit',[
            'players' => $player,
            'teams' => $team,
            'team_id' => Team::where('id',$team->id)->get(),
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
    public function update(Request $request, $id , Player $player)
    {
        $rules = [
            'name' => 'required|max:255',
            'team_id' => 'required',
            'place_birthdate' => 'required',
            'gender' => 'required',
            'position' => 'required',
            'status' => 'required',
        ];

        if($request->slug != $player->slug){
            $rules['slug'] = 'required|unique:players';
        }

        $validatedData = $request->validate($rules);
        
        Player::where('id', $player->id)->update($validatedData);

        alert()->success('Player Successful Updated!', 'Success');
        return redirect('dashboard/teams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Player $player)
    {
        Player::destroy($player->id);

        alert()->success('Player Successful Deleted!', 'Success');
        return redirect('dashboard/teams');
    }
}