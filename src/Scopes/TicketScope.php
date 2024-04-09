<?php

namespace Lumina\Tickets\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Lumina\Tickets\Enums\Status;

trait TicketScope
{
    /**
     * Get closed tickets
     */
    public function scopeClosed(Builder $builder): Builder
    {
        return $builder->where('status', Status::CLOSED->value);
    }

    /**
     * Get opened tickets
     */
    public function scopeOpened(Builder $builder): Builder
    {
        return $builder->where('status', Status::OPEN->value);
    }
}
