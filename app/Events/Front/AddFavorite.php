<?php

namespace App\Events\Front;

use App\Models\FavoriteItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddFavorite
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $favorite;
    /**
     * Create a new event instance.
     */
    public function __construct(FavoriteItem $favorite)
    {
        $this->favorite = $favorite;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
