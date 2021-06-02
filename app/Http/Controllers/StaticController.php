<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StaticController extends Controller
{
    /**
     * Shows the home page
     *
     * @return Response
     */

    public function showAbout()
    {
      return view('pages.about');
    }

    public function showNotFound()
    {
      return view('errors.404');
    }
}
