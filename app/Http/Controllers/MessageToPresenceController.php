<?php

namespace App\Http\Controllers;

use App\Entities\Message;
use App\Entities\MessageManagement;
use App\Entities\User;
use App\Events\MessageToPresenceUsersEvent;
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
        $user = Auth::user();
        // create message
        $message = Message::create([
            'message' => $request->get('message'),
        ]);

        foreach ($request->get('to_users') as $toUserId) {
            // create MessageManagement
            $messageManagement = MessageManagement::create([
                'message_id' => $message->id,
                'to_user_id' => $toUserId,
                'from_user_id' => $user->id,
            ]);

            event(new MessageToPresenceUsersEvent(
                Auth::user(),
                $message->message,
                $toUserId,
                $messageManagement
            ));
        }
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
        // id が key, name, online が val の配列を再編成
        $userList = array_column($userList, null, 'id');
        return $userList;
    }

    public function getMyMessages()
    {
        $toMeMessages = MessageManagement::where('to_user_id', Auth::user()->id)->get();
        $messageList = [];
        foreach ($toMeMessages as $item) {
            /** @var MessageManagement $item */
            $message = Message::find($item->message_id);
            $fromUser = User::find($item->from_user_id);
            $messageList[] = [
                'message' => $message->message,
                'fromUser' => $fromUser,
                'messageManagementId' => $item->id,
                'readStatus' => $item->read_status,
            ];
        }
        return $messageList;
    }

    public function changeReadStatus(Request $request)
    {
        $message = $request->get('message');
        $messageManagement = MessageManagement::find($message['messageManagementId']);
        $messageManagement->update([
            'read_status' => $messageManagement->switchStatus()
        ]);

        return;
    }
}