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

// message to a group
// 自分のグループ宛に送られたイベントのみリッスンする
Broadcast::channel('message-to-users-channel.{group}', function($user, $group) {
    return true;
});

// message to a group
// 自分のグループ宛に送られたイベントのみリッスンする
Broadcast::channel('message-to-group-channel.{group}', function($user, $group) {
    return true;
});

// presence
Broadcast::channel('presence-user-channel', function($user) {
    if (Auth::user()->id == $user->id) {
        return ['id' => $user->id, 'name' => $user->name];
    }
    return null;
});

