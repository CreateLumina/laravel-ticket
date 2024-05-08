<?php

use Lumina\Tickets\Models\Category;
use Lumina\Tickets\Models\Ticket;
use Lumina\Tickets\Tests\Models\User;

it('creates a ticket with associated user', function () {
    $user = User::factory()->create();

    Ticket::factory()->create([
        'title' => 'IT Support',
        'user_id' => $user->id,
    ]);

    $this->assertEquals($user->tickets()->count(), 1);
    $this->assertEquals($user->tickets()->first()->title, 'IT Support');
});

it('associates categories to a ticket', function () {
    $categories = Category::factory()->times(3)->create();
    $ticket = Ticket::factory()->create();

    $ticket->attachCategories($categories->pluck('id'));

    $this->assertEquals($ticket->categories->count(), 3);
});

it('sync categories to a ticket', function () {
    $categories = Category::factory()->times(2)->create();
    $ticket = Ticket::factory()->create();

    $ticket->syncCategories($categories->pluck('id'));

    $this->assertEquals($ticket->categories->count(), 2);
});

it('sync categories to a ticket without detaching', function () {
    $categories = Category::factory()->times(3)->create();
    $ticket = Ticket::factory()->create();
    $ticket->attachCategories($categories->pluck('id'));

    $anotherCategories = Category::factory()->times(2)->create();

    $ticket->syncCategories($anotherCategories->pluck('id'), false);

    $this->assertEquals($ticket->categories->count(), 5);
});

it('can create a message inside the ticket by authenticated user', function () {
    $this->actingAs(User::factory()->create());

    $ticket = Ticket::factory()->create();

    $ticket->message('How are you today?');

    $this->assertEquals($ticket->messages->count(), 1);
});
