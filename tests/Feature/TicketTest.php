<?php

use Coderflex\LaravelTicket\Models\Ticket;
use Coderflex\LaravelTicket\Tests\Models\User;

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

    $this->assertEquals(Ticket::count(), 10);
    $this->assertEquals(Ticket::opened()->count(), 3);
    $this->assertEquals(Ticket::closed()->count(), 7);
});

it('can close the ticket', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $ticket->close();

    $this->assertEquals($ticket->status, 'closed');
});

it('can reopen the ticket', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'closed',
    ]);

    $ticket->reopen();

    $this->assertEquals($ticket->status, 'open');
});

it('can check if the ticket is open/closed', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $closedTicket = Ticket::factory()->create([
        'status' => 'closed',
    ]);

    $this->assertTrue($ticket->isOpen());
    $this->assertTrue($closedTicket->isClosed());
});

it('can mark a ticket as closed', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $this->assertTrue($ticket->isClosed());
});

it('can mark a ticket as reopened', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'closed',
    ]);

    $this->assertTrue($ticket->isOpen());
});

it('can delete a ticket', function () {
    $ticket = Ticket::factory()->create();

    $ticket->delete();

    $this->assertEquals(Ticket::count(), 0);
});
