<?php

namespace App\Events;

use App\Http\Resources\Admin\Orders\OrderResource;
use App\Models\User;
use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewOrder implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-order');
    }

    public function broadcastWith()
    {
        return
        [
            'id' => $this->order->id,
            'user' => [
                'id' => $this->order->user->id,
                'name' => $this->order->user->name
            ],
            'address' => $this->order->address->street,
            'type' => $this->order->type,
            'services' => mb_substr($this->order->services_string, 0, 20, 'UTF-8'),
            'service_provider' => $this->order->serviceProvider ? [
                'id' => $this->order->serviceProvider->id,
                'name' => $this->order->serviceProvider->name,
            ] : null,
            'status' => [
                'code' => $this->order->status,
                'string' => $this->order->status_string
            ]
        ];
    }
}
