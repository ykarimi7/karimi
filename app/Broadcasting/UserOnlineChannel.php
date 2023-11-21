<?php /** @noinspection PhpInconsistentReturnPointsInspection */

namespace App\Broadcasting;

use Illuminate\Support\Facades\Auth;

class UserOnlineChannel
{
    public function join($user, $id)
    {
        if ($user != null) {
            return ['id'=> $user->id,'name' => $user->name];
        }
    }
}