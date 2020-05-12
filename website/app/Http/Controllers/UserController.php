<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function page($id)
    {
        return view('pages.profile', ['user' => User::findOrFail($id)]);
    }

    public function editPage()
    {
        $this->authorize('edit', User::class);
        return view('pages.editProfile');
    }

    public function edit(Request $data)
    {
        $this->authorize('edit', User::class);

        $this->validate($request, [
            'name' => 'bail|max:32',
            'email' => 'bail|required|unique:user|email',
            'username' => 'bail|required|unique:user|min:3|max:32',
            'description' => 'bail|max:1500'
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->description = $data['description'];

        $user->save();

        return redirect()->route('profile', ['id' => $id]);
    }
}
