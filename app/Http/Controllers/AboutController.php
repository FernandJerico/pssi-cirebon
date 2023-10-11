<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Official;
use App\Models\Team;

class AboutController extends Controller
{
    public function index(){
        $excludedStatuses = ['exco', 'keuangan-dan-bisnis','disiplin', 'etik', 'banding'];
        $includedStatuses = ['disiplin', 'etik', 'banding'];
        return view('about', [
            "title" => "About",
            "exco" => Official::where('status', 'EXCO')->get(),
            "komtap" => Official::distinct()->whereNotIn('status', $excludedStatuses)
            ->pluck('status'),
            "yudisial" => Official::distinct()->whereIn('status', $includedStatuses)->pluck('status'),
            "categories" => Category::get(),
            "list_teams" => Team::get(),
        ]);
    }

    public function loadData(Request $request) {
        $status = $request->input('status');
    
        // Query data dari tabel officials berdasarkan status yang dipilih
        $data = Official::select('name', 'position')
            ->where('status', $status)
            ->get();
    
        return response()->json($data);
    }
}