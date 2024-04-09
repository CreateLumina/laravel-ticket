<?php

namespace Lumina\Tickets\Tests\Database\Factories;

use Lumina\Tickets\Models\Ticket;
use Lumina\Tickets\Tests\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'user_id' => User::factory(),
            'title' => $this->faker->title(),
            'message' => $this->faker->paragraph(2),
            'status' => $this->faker->randomElement(['open', 'closed']),
        ];
    }
}
