<?php

namespace Lumina\Tickets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Lumina\Tickets\Models\Message
 *
 * @property int $user_id
 * @property string $message
 */
class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get Ticket RelationShip
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(
            Ticket::class,
            'ticket_id'
        );
    }

    /**
     * Get Message Relationship
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            config('auth.providers.users.model'),
            'user_id'
        );
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return 'messages';
    }
}
