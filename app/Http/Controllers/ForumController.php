<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $generalRoom = ChatRoom::firstOrCreate(
            ['name' => 'General Chat'],
            ['type' => 'group']
        );

        $admin = User::where('is_admin', true)->first();
        $rooms = [
            [
                'id' => $generalRoom->id,
                'name' => 'General',
                'type' => 'group',
                'subtitle' => 'Semua orang ada di sini',
            ],
        ];

        if ($admin && $admin->id !== $user->id) {
            $privateRoom = $this->getPrivateRoom($user->id, $admin->id);
            $rooms[] = [
                'id' => $privateRoom->id,
                'name' => 'Admin',
                'type' => 'private',
                'subtitle' => 'Chat pribadi dengan Admin',
            ];
        }

        $requestedRoomId = $request->query('room_id');
        $activeRoomId = $requestedRoomId && collect($rooms)->contains('id', (int) $requestedRoomId)
            ? (int) $requestedRoomId
            : $generalRoom->id;

        $messageCounts = Message::whereIn('chat_room_id', collect($rooms)->pluck('id'))
            ->selectRaw('chat_room_id, count(*) as count')
            ->groupBy('chat_room_id')
            ->pluck('count', 'chat_room_id');

        $rooms = collect($rooms)->map(function ($room) use ($messageCounts) {
            $room['messages'] = $messageCounts[$room['id']] ?? 0;
            return $room;
        })->all();

        $messages = Message::with('user')
            ->where('chat_room_id', $activeRoomId)
            ->orderBy('created_at')
            ->get();

        return view('forum_diskusi', compact('rooms', 'messages', 'activeRoomId'));
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'chat_room_id' => 'required|exists:chat_rooms,id',
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $room = ChatRoom::findOrFail($request->chat_room_id);

        if ($room->type === 'private' && ! $room->participants()->where('user_id', $user->id)->exists()) {
            abort(403);
        }

        Message::create([
            'chat_room_id' => $room->id,
            'user_id' => $user->id,
            'body' => $request->message,
        ]);

        return redirect()->to('/forum-diskusi?room_id=' . $room->id)->with('success', 'Pesan berhasil dikirim.');
    }

    private function getPrivateRoom(int $userId, int $adminId): ChatRoom
    {
        $ids = [$userId, $adminId];
        sort($ids, SORT_NUMERIC);
        $roomName = "private-chat-{$ids[0]}-{$ids[1]}";

        $room = ChatRoom::firstOrCreate([
            'name' => $roomName,
        ], [
            'type' => 'private',
        ]);

        $room->participants()->syncWithoutDetaching($ids);

        return $room;
    }
}
