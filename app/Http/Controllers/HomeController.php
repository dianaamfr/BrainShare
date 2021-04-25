<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Shows the home page
     *
     * @return Response
     */
    public function show()
    {
      return view('pages.home');
    }

    public function showAbout()
    {
      return view('pages.about');
    }

    public function showError()
    {
      return view('pages.error');
    }
}
