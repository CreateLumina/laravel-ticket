<?php

use Lumina\Tickets\Models\Message;
use Lumina\Tickets\Models\Ticket;

it('can store a message', function () {
    $ticket = Ticket::factory()->create([
        'title' => 'Laravel is cool!',
    ]);

    $message = Message::factory()
        ->create([
            'ticket_id' => $ticket->id,
            'message' => 'Message from a ticket',
        ]);

    $this->assertDatabaseHas('messages', [
        'ticket_id' => $ticket->id,
        'message' => 'Message from a ticket',
    ]);

    $this->assertEquals($message->count(), 1);
    $this->assertEquals($message->ticket->title, 'Laravel is cool!');
});
