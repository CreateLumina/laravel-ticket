<?php

namespace Coderflex\LaravelTicket\Concerns;

use Coderflex\LaravelTicket\Enums\Status;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Add new message on an existing ticket as a custom user
     */
    public function assignTo(Model|int $user): self
    {
        $this->update([
            'assigned_to' => $user,
        ]);

        return $this;
    }
}
