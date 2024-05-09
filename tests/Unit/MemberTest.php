<?php

use Lumina\Tickets\Models\Ticket;
use Lumina\Tickets\Tests\Models\User;

it('can add member to a ticket', function () {
    $user = User::factory()->create();
    $ticket = Ticket::factory()->create([
        'title' => 'Can you add a member?',
    ]);

    $ticket->addMember($user->id);

    $this->assertDatabaseHas('members', [
        'user_id' => $user->id,
        'ticket_id' => $ticket->id,
    ]);
});

it('can remove member from a ticket', function () {
    $user = User::factory()->create();
    $ticket = Ticket::factory()->create([
        'title' => 'Can you remove a member?',
    ]);

    $ticket->addMember($user->id);
    $ticket->removeMember($user->id);

    $this->assertDatabaseMissing('members', [
        'user_id' => $user->id,
        'ticket_id' => $ticket->id,
    ]);
});
