<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function edit(User $user)
    {
        return view('user.profile');
    }

    public function update(Request $request, User $user)
    {
    	$this->validate(request(), [
            'name'  =>  'required'
        ]);

        $user->name = $request->name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();

        return redirect()->route('home');
    }
}
