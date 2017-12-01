<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// message broadcast channel
Broadcast::channel('message-chanel', function() {
    return true;
});

//// message to a user
//// 自分の user->id 宛に送られたイベントのみリッスンする
Broadcast::channel('message-to-user-channel', function($user) {
    return true;
});

// message to a group
// 自分のグループ宛に送られたイベントのみリッスンする
Broadcast::channel('message-to-group-channel.{group}', function($user, $group) {
    \Log::debug($group);
    return true;
});
