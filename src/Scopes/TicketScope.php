<?php

namespace Coderflex\LaravelTicket\Scopes;

use Coderflex\LaravelTicket\Enums\Status;
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

    /**
     * Get archived tickets
     */
    public function scopeArchived(Builder $builder): Builder
    {
        return $builder->where('status', Status::ARCHIVED->value);
    }

    /**
     * Get unarchived tickets
     */
    public function scopeUnArchived(Builder $builder): Builder
    {
        return $builder->whereNot('status', Status::ARCHIVED->value);
    }
}
