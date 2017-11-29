<?php

namespace App\Http\Controllers;

use App\Events\PostMessageEvent;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('message', []);
    }

    public function post(Request $request)
    {
        event(new PostMessageEvent(Auth::user(), $request->get('message')));
    }
}