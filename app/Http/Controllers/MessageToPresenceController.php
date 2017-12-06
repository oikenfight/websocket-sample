<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Events\MessageToPresenceUserEvent;
use Auth;
use Illuminate\Http\Request;

class MessageToPresenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('message-to-presence', []);
    }

    public function post(Request $request)
    {
        event(new MessageToPresenceUserEvent(Auth::user()));
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