<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(User $user)
    {
        return view('test', compact('user'));
    }
}
