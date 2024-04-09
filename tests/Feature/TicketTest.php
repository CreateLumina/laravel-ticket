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

    Ticket::factory()
        ->times(6)
        ->create([
            'status' => 'archived',
        ]);

    $this->assertEquals(Ticket::count(), 16);
    $this->assertEquals(Ticket::opened()->count(), 3);
    $this->assertEquals(Ticket::closed()->count(), 7);
    $this->assertEquals(Ticket::archived()->count(), 6);
    $this->assertEquals(Ticket::unArchived()->count(), 10);
});

it('filters tickets by locked status', function () {
    Ticket::factory()
        ->times(3)
        ->create([
            'is_locked' => true,
        ]);

    Ticket::factory()
        ->times(9)
        ->create([
            'is_locked' => false,
        ]);

    $this->assertEquals(Ticket::count(), 12);
    $this->assertEquals(Ticket::locked()->count(), 3);
    $this->assertEquals(Ticket::unlocked()->count(), 9);
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

it('can check if the ticket is open/closed/archived', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $archivedTicket = Ticket::factory()->create([
        'status' => 'archived',
    ]);

    $closedTicket = Ticket::factory()->create([
        'status' => 'closed',
    ]);

    $this->assertTrue($ticket->isOpen());
    $this->assertTrue($closedTicket->isClosed());
    $this->assertTrue($archivedTicket->isArchived());
});

it('can mark a ticket as archived', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
    ]);

    $ticket->markAsArchived();

    $this->assertTrue($ticket->isArchived());
});

it('can mark a ticket as locked', function () {
    $ticket = Ticket::factory()->create([
        'is_locked' => false,
    ]);

    $ticket->markAsLocked();

    $this->assertTrue($ticket->isLocked());
});

it('can mark a ticket as unlocked', function () {
    $ticket = Ticket::factory()->create([
        'is_locked' => true,
    ]);

    $ticket->markAsUnlocked();

    $this->assertTrue($ticket->isUnlocked());
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

it('can mark a ticket as locked & unlocked', function () {
    $ticket = Ticket::factory()->create([
        'is_locked' => false,
    ]);

    $lockedTicket = Ticket::factory()->create([
        'is_locked' => true,
    ]);

    $this->assertTrue($ticket->isUnlocked());
    $this->assertTrue($lockedTicket->isLocked());
});

it('ensures ticket methods are chainable', function () {
    $ticket = Ticket::factory()->create([
        'status' => 'open',
        'is_locked' => false,
    ]);

    $ticket->archive()
        ->markAsLocked();

    $this->assertTrue($ticket->isArchived());
    $this->assertTrue($ticket->isLocked());
});

it('can delete a ticket', function () {
    $ticket = Ticket::factory()->create();

    $ticket->delete();

    $this->assertEquals(Ticket::count(), 0);
});

it('can assign ticket to a user using user model', function () {
    $ticket = Ticket::factory()->create();
    $agentUser = User::factory()->create();

    $ticket->assignTo($agentUser);

    expect($ticket->assigned_to)
        ->toBe($agentUser);
});

it('can assign ticket to a user using user id', function () {
    $ticket = Ticket::factory()->create();
    $agentUser = User::factory()->create();

    $ticket->assignTo($agentUser->id);

    expect($ticket->assigned_to)
        ->toBe($agentUser->id);
});

