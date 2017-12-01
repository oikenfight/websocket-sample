<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Events\PostMessageToGroupEvent;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MessageToGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('message-to-group', []);
    }

    public function post(Request $request)
    {
        event(new PostMessageToGroupEvent(
            Auth::user(),
            $request->get('message'),
            $request->get('to_group')
        ));
    }

    public function getAllGroup()
    {
        /** @var Collection|User[] $groupList */
        $groupList = new Collection();
        foreach (User::all() as $item) {
            $groupList->push([
                'group' => $item->group,
            ]);
        }
        $groupList = $groupList->unique('group')->toArray();
        // id を key とした連想配列を返却
        return $groupList;
    }
}