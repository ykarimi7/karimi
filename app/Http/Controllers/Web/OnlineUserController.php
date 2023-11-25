<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OnlineUserController extends Controller
{
    /*
     * calculate full_time_online user for show in page =>
     * $duration = Carbon::now()->addSeconds($user->full_time_online)->diffForHumans(null, true);
     */
    public function online(Request $request)
    {
        $user = User::findOrFail($request->userId);
        $user->lastActivity = Carbon::now();
        $user->save();
    }

    public function offline(Request $request)
    {
        try {
            $user = User::findOrFail($request->userId);
            $lastActivityTime = $user->lastActivity;
            if (!$lastActivityTime) {
                return response()->json(['error' => 'Last activity time not available'], 404);
            }
            $durationInSeconds = Carbon::parse($lastActivityTime)->diffInSeconds();
            $user->full_time_online = $user->full_time_online + $durationInSeconds;
            $user->lastActivity = Carbon::now();
            $user->save();
            return response()->json(['message' => 'user exists from web']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
