<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MTicket implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mTicket;

    /**
     * Create a new event instance.
     *
     * @param null $mTicket
     */
    public function __construct($mTicket = null)
    {
        $this->mTicket = $mTicket;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('counter');
    }

//    public function broadcastWith()
//    {
//        $new = \App\mTicket::where('is_new',True)->count();
//        $myActive = mTicket::where([['assigned_to', 'Like', '%' . Auth::user()->fname . '%']])->where([['status', '=', 'Active']])->count();
//        return [
//            'new' => $new,
//            'active' => $myActive,
//        ];
//    }
}
