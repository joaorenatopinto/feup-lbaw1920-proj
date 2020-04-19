<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller {
    /**
     * Shows the user profile for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
      $user = User::find($id);
      $this->authorize('show', $user);
      return view('pages.user', ['user' => $user]);
    }

    /**
     * Show edit form of the user profile for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function showEditForm($id) {
      $user = User::find($id);
      $this->authorize('edit', $user);
      return view('pages.edituserform', ['user' => $user]);
    }

    /**
     * Edit the user profile for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
      $user = User::find($id);
      $this->authorize('edit', $user);
      return view('pages.edituser', ['user' => $user]);
    }



}
