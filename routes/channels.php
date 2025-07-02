<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('eve-channel.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id || $user->role === 'admin';
});

Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    $chat = \App\Models\Chat::find($chatId);
    return $chat && (
            $chat->user_id === $user->id ||
            $user->role === 'admin'
        );
});
Broadcast::channel('chat-status.{chatId}', function ($user, $chatId) {
    $chat = \App\Models\Chat::find($chatId);
    return $chat && (
            $chat->user_id === $user->id ||
            $user->role === 'admin'
        );
});

Broadcast::channel('user.{userId}.new-chat-create', function ($user, $userId) {
    return (int)$user->id === (int)$userId ||
        $user->role === 'admin';
});
