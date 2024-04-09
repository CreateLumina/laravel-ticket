<?php

namespace Lumina\Tickets\Concerns;

use Lumina\Tickets\Enums\Status;

trait InteractsWithTickets
{
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
     * Reopen the ticket
     */
    public function reopen(): self
    {
        $this->update([
            'status' => Status::OPEN->value,
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
        return !$this->isOpen();
    }
}
