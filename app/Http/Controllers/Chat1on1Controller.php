<?php

namespace App\Http\Controllers;

class Chat1on1Controller extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('chat-1on1');
    }
}