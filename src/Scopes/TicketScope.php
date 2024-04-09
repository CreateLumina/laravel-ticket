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
     * Get resolved tickets
     */
    public function scopeResolved(Builder $builder): Builder
    {
        return $builder->where('is_resolved', true);
    }

    /**
     * Get unresolved tickets
     */
    public function scopeUnresolved(Builder $builder): Builder
    {
        return $builder->where('is_resolved', false);
    }

    /**
     * Get locked tickets
     */
    public function scopeLocked(Builder $builder): Builder
    {
        return $builder->where('is_locked', true);
    }

    /**
     * Get unlocked tickets
     */
    public function scopeUnlocked(Builder $builder): Builder
    {
        return $builder->where('is_locked', false);
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
