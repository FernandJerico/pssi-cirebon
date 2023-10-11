<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;
use Alert;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'categories' => Category::all(),
            'list_teams' => Team::get()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|alpha',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|max:255'     
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        alert()->success('Registration Successful!', 'Success');
        return redirect('/login');
    }
}