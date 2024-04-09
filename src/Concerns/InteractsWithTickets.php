<?php

namespace Coderflex\LaravelTicket\Concerns;

use Coderflex\LaravelTicket\Enums\Status;
use Illuminate\Database\Eloquent\Model;

trait InteractsWithTickets
{
    /**
     * Archive the ticket
     */
    public function archive(): self
    {
        $this->update([
            'status' => Status::ARCHIVED->value,
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
     * Determine if the ticket is archived
     */
    public function isArchived(): bool
    {
        return $this->status == Status::ARCHIVED->value;
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
     * Mark the ticket as archived
     */
    public function markAsArchived(): self
    {
        $this->archive();

        return $this;
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
