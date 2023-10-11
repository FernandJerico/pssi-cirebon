<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Player;
use App\Models\Team;
use App\Models\Coach;

class TeamController extends Controller
{
    public function index()
    {
        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name; 
        }

        return view('teams', [
            "title" => "All Clubs" . $title,
            "categories" => Category::get(),
            "teams" => Team::filter(request(['search', 'category']))->paginate(16)->withQueryString(),
            "list_teams" => Team::get(),
            "coaches" => Coach::get(),
        ]);
    }

    public function show(Team $team)
    {
        return view('team', [
            "title" => "Detail Club",
            "team" => $team,
            "categories" => Category::get(),
            "list_teams" => Team::get(),
            "players" => Player::where('team_id', $team->id)->get(),
            "coaches" => Coach::where('team_id', $team->id)->get(),
        ]);
    }
}