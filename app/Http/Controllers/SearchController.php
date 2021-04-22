<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Shows the home page
     *
     * @return Response
     */
    public function show()
    {
      return view('pages.search');
    }
}
