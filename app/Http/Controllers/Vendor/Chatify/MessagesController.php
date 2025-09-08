<?php

namespace App\Http\Controllers\Vendor\Chatify;

use Chatify\Http\Controllers\MessagesController as BaseMessagesController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessagesController extends BaseMessagesController
{
    public function search(Request $request)
    {
        try {
            $input = $request->input('input', '');
            $offset = $request->input('offset', 0);
            $type = $request->input('type', 'default');
            
            $query = User::where('id', '!=', Auth::id())
                ->where(function($q) use ($input) {
                    $q->where('first_name', 'LIKE', "%{$input}%")
                      ->orWhere('last_name', 'LIKE', "%{$input}%")
                      ->orWhere('username', 'LIKE', "%{$input}%")
                      ->orWhere('email', 'LIKE', "%{$input}%");
                });

            // Jika type adalah 'contacts', hanya tampilkan kontak yang sudah ada chat-nya
            if ($type === 'contacts') {
                $query->whereHas('chats', function($q) {
                    $q->where('from_id', Auth::id())
                      ->orWhere('to_id', Auth::id());
                });
            }

            $users = $query->orderBy('first_name')
                         ->limit(30)
                         ->offset($offset)
                         ->get()
                         ->map(function($user) {
                             return [
                                 'id' => $user->id,
                                 'name' => $user->first_name . ' ' . $user->last_name,
                                 'username' => $user->username,
                                 'avatar' => $user->avatar ?? null,
                                 'email' => $user->email,
                             ];
                         });

            return response()->json([
                'total' => $users->count(),
                'contacts' => $users,
                'users' => $users,
                'last_page' => $users->count() < 30,
                'current_page' => intval($offset / 30) + 1
            ]);

        } catch (\Exception $e) {
            Log::error('Chatify Search Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => [
                    'status' => 500,
                    'message' => 'Internal Server Error',
                    'details' => config('app.debug') ? $e->getMessage() : null
                ]
            ], 500);
        }
    }
}