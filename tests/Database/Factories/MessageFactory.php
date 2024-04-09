<?php

namespace Lumina\Tickets\Tests\Database\Factories;

use Lumina\Tickets\Models\Message;
use Lumina\Tickets\Models\Ticket;
use Lumina\Tickets\Tests\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        $tableName = config('laravel_ticket.table_names.messages', 'messages');

        return [
            'user_id' => User::factory(),
            $tableName['columns']['ticket_foreign_id'] => Ticket::factory(),
            'message' => $this->faker->paragraph(2),
        ];
    }
}
