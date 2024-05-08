<?php

namespace Lumina\Tickets\Concerns;

use Lumina\Tickets\Enums\Status;

trait InteractsWithTickets
{
    /**
     * Open the ticket
     */
    public function open(): self
    {
        $this->update([
            'status' => Status::OPEN->value,
        ]);

        return $this;
    }

    /**
     * Close the ticket
     */
    public function close(): self
    {
        $this->update([
            'status' => Status::CLOSED->value,
        ]);

        return $this;
    }

    /**
     * Determine if the ticket is open
     */
    public function isOpen(): bool
    {
        return $this->status == Status::OPEN->value;
    }

    /**
     * Determine if the ticket is closed
     */
    public function isClosed(): bool
    {
        return ! $this->isOpen();
    }
}
