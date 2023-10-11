<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function update(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:255',
        ]);

        $user_login = auth()->user();
        if (!Hash::check($request->current_password, $user_login->password)) {
            alert()->error('Failed', 'Your Current Password is Incorrect');
            return back();
        }
        
        $user = User::find($user_login->id);
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        alert()->success('Password Successful Updated!', 'Success');
        return redirect('dashboard');
    }
}