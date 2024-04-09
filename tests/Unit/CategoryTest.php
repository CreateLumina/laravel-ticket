<?php

use Lumina\Tickets\Models\Category;
use Lumina\Tickets\Models\Ticket;

it('can store a category', function () {
    $ticket = Ticket::factory()->create();

    $category = Category::factory()->create([
        'name' => 'Support',
        'slug' => 'supoort',
    ]);

    $this->assertDatabaseHas('categories', [
        'name' => 'Support',
        'slug' => 'supoort',
    ]);

    $this->assertEquals($category->count(), 1);
});
