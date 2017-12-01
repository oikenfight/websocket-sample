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

//// message to limited user channel
//// 自分の user->id 宛に送られたイベントのみリッスンする
Broadcast::channel('message-to-user-channel', function($user) {
    \Log::debug($user);
    return true;
});
