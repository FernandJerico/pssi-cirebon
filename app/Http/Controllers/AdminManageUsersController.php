<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminManageUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('is_admin');
        return view('dashboard.manage-users.index', [
            'categories' => Category::all(),
            'countUnapprovedPosts' => Post::where('is_approved', 0)->count(),
            'users' => User::where('is_admin', 0)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('is_admin');
        return view('dashboard.manage-users.create',[
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
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'is_admin' => 'required',
            'password' => 'required|min:6|max:255'     
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        alert()->success('Users Successful Added!', 'Success');
        return redirect('/dashboard/manage-users');
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
    public function edit(User $manage_user)
    {
        $this->authorize('is_admin');
        return view('dashboard.manage-users.edit',[
            'users' => $manage_user,
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
    public function update(Request $request, User $manage_user)
    {
        $rules = [
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users,username,'.$manage_user->id],
            'email' => 'required|email:dns|unique:users,email,'.$manage_user->id,
            'is_admin' => 'required',
            'password' => 'required|min:6|max:255'
        ];

        $validatedData = $request->validate($rules);

        // Hash the password if it's included in the request
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        // Update user's information
        $manage_user->update($validatedData);

        alert()->success('User Successful Updated!', 'Success');
        return redirect('dashboard/manage-users');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $manage_user)
    {
        User::destroy($manage_user->id);

        alert()->success('User Successful Deleted!', 'Success');
        return redirect('dashboard/manage-users');
    }
}