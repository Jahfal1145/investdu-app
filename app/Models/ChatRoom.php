<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'chat_participants');
    }

    public static function privateRoom(int $userId, int $adminId): self
    {
        $ids = [$userId, $adminId];
        sort($ids, SORT_NUMERIC);
        $roomName = "private-chat-{$ids[0]}-{$ids[1]}";

        $room = self::firstOrCreate([
            'name' => $roomName,
        ], [
            'type' => 'private',
        ]);

        $room->participants()->syncWithoutDetaching($ids);

        return $room;
    }
}
