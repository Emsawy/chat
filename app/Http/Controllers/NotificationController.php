<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use App\User;

class NotificationController extends Controller
{
    public function notify($sender_id, $mess_id)
    {
        $options = array(
                        'cluster' => env('PUSHER_APP_CLUSTER'),
                        'encrypted' => true
                        );
        $pusher = new Pusher(
                            env('PUSHER_APP_KEY'),
                            env('PUSHER_APP_SECRET'),
                            env('PUSHER_APP_ID'),
                            $options
                        );

        $sender = User::findOrFail($sender_id);
        $data['info'] = $sender->messages()->where('target_id', $mess_id)->orderBy('created_at', 'desc')->get();
        $pusher->trigger('notify-channel', 'App\\Events\\Notify', $data);
        return redirect()->route('users.index');
    }
}
