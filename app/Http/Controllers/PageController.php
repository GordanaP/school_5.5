<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Services\Utilities\Year;
use App\Subject;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
}
