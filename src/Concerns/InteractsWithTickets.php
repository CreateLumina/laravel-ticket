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
     * Lock the ticket
     */
    public function lock(): self
    {
        $this->update([
            'status' => Status::LOCKED->value,
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

    /**
     * Determine if the ticket is locked
     */
    public function isLocked(): bool
    {
        return $this->status == Status::LOCKED->value;
    }
}
