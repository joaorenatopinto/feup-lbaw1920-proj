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

    public function editPage($id) {
        $user = User::find($id);
        $this->authorize('edit', $user);
        return view('pages.editProfile', ['user' => $user]);
    }

    public function edit(Request $data, $id) {
        $user = User::find($id);
        $this->authorize('edit', $user);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->description = $data['description'];

        $user->save();

        return redirect()->route('profile',['id' => $id]);
    }
}
