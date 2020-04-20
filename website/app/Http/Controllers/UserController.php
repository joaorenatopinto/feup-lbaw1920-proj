<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function show($id)
    {
      $user = User::find($id);
      $this->authorize('show', $user);
      return view('pages.profile', ['user' => $user]]);
    }
}
