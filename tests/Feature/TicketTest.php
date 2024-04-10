<?php

use Lumina\Tickets\Models\Ticket;

it('filters tickets by status', function () {
    Ticket::factory()
        ->times(3)
        ->create([
            'status' => 'open',
        ]);

    Ticket::factory()
        ->times(7)
        ->create([
            'status' => 'closed',
        ]);

    Ticket::factory()
        ->times(5)
        ->create([
            'status' => 'locked',
        ]);

    $this->assertEquals(Ticket::count(), 15);
    $this->assertEquals(Ticket::opened()->count(), 3);
    $this->assertEquals(Ticket::closed()->count(), 7);
    $this->assertEquals(Ticket::locked()->count(), 5);
});

it('can open the ticket', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'closed',
    ]);

    $ticket->open();

    $this->assertEquals($ticket->status, 'open');
});

it('can close the ticket', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $ticket->close();

    $this->assertEquals($ticket->status, 'closed');
});

it('can lock the ticket', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $ticket->lock();

    $this->assertEquals($ticket->status, 'locked');
});

it('can check if the ticket is open/closed', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $closedTicket = Ticket::factory()->create([
        'status' => 'closed',
    ]);

    $lockedTicket = Ticket::factory()->create([
        'status' => 'locked',
    ]);

    $this->assertTrue($ticket->isOpen());
    $this->assertTrue($closedTicket->isClosed());
    $this->assertTrue($lockedTicket->isLocked());
});

it('can delete a ticket', function () {
    $ticket = Ticket::factory()->create();

    $ticket->delete();

    $this->assertEquals(Ticket::count(), 0);
});
