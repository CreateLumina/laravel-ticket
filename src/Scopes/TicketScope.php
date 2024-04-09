<?php

namespace Lumina\Tickets\Scopes;

use Lumina\Tickets\Enums\Status;
use Illuminate\Database\Eloquent\Builder;

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
