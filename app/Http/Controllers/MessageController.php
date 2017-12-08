<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Events\CallbackStatusEvent;
use App\Events\CallStatusEvent;
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

    public function call()
    {
        event(new CallStatusEvent(Auth::user()));
    }

    public function callback()
    {
        event(new CallbackStatusEvent(Auth::user()));
    }

    public function getAllUsers()
    {
        /** @var array|User[] $userList */
        $userList = [];
        foreach (User::all() as $item) {
            $userList[] = [
                'id' => $item->id,
                'name' => $item->name,
                'online' => false
            ];
        }
        // id が key, name が val の配列を再編成
        $userList = array_column($userList, null, 'id');
        return $userList;
    }
}