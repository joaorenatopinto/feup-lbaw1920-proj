<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    /**
     * Shows homepage.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
      return view('pages.home');
    }
}
