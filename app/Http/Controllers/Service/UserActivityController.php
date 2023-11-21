<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    public function updateOnlineStatus(Request $request)
    {
        info('Update Online Status:', [
            'user' => $request->user(),
            'full_time_online' => $request->input('full_time_online', 0),
        ]);
//        $user = $request->user();
//        $fullTimeOnline = $request->input('full_time_online', 0);
//
//        // Update the user's full_time_online attribute
//        $user->full_time_online = $fullTimeOnline;
//        $user->save();
//
//        return response()->json(['success' => true]);
    }
}
