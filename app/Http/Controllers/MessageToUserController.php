<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Events\PostMessageToUserEvent;
use Auth;
use Illuminate\Http\Request;

class MessageToUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('message-to-user', []);
    }

    public function post(Request $request)
    {
        event(new PostMessageToUserEvent(
            Auth::user(),
            $request->get('message'),
            $request->get('toUserId')
        ));
    }

    public function getAllUser()
    {
        /** @var array|User[] $dkBoardList */
        $userList = [];
        foreach (User::all() as $item) {
            $userList[] = [
                'id' => $item->id,
                'name' => $item->name,
            ];
        }
        // id を key とした連想配列を返却
        return $userList;
    }
}