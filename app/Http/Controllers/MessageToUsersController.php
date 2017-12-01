<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Events\PostMessageToUsersEvent;
use Auth;
use Illuminate\Http\Request;

class MessageToUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('message-to-users', []);
    }

    public function post(Request $request)
    {
        foreach ($request->get('to_users') as $toUserId) {
            event(new PostMessageToUsersEvent(
                Auth::user(),
                $request->get('message'),
                $toUserId
            ));
        }
    }

    public function getUsers()
    {
        /** @var array|User[] $dkBoardList */
        $userList = [];
        foreach (User::where('group', Auth::user()->group)->get() as $item) {
            $userList[] = [
                'id' => $item->id,
                'name' => $item->name,
            ];
        }
        // id を key とした連想配列を返却
        return $userList;
    }
}