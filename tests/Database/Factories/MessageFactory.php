<?php

namespace Lumina\Tickets\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Lumina\Tickets\Models\Message;
use Lumina\Tickets\Models\Ticket;
use Lumina\Tickets\Tests\Models\User;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'ticket_id' => Ticket::factory(),
            'message' => $this->faker->paragraph(2),
        ];
    }
}
