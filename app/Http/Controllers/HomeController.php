<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Admin Panel";
        return view('admin.index')->with(compact('title'));
        // return view('home');
    }
}
