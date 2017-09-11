<?php

namespace App\Http\Controllers;

use App\Services\Utilities\Year;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
}
