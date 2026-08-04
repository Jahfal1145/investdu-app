<?php

use App\Models\ChatRoom;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat-room.{roomId}', function ($user, $roomId) {
    $room = ChatRoom::find($roomId);

    if (! $room) {
        return false;
    }

    if ($room->type === 'group') {
        return true;
    }

    return $room->participants()->where('user_id', $user->id)->exists();
});
