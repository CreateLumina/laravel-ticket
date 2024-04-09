<?php

use Lumina\Tickets\Models\Category;
use Lumina\Tickets\Models\Ticket;

it('can attach category to a ticket', function () {
    $category = Category::factory()->create();
    $ticket = Ticket::factory()->create();

    $category->tickets()->attach($ticket);

    $this->assertEquals($category->tickets->count(), 1);
});

it('can deattach category to a ticket', function () {
    $category = Category::factory()->create();
    $ticket = Ticket::factory()->create();

    $ticket->attachCategories($category);

    $category->tickets()->detach($ticket);

    $this->assertEquals($category->tickets->count(), 0);
});
