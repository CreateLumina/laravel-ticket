<?php

namespace Lumina\Tickets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lumina\Tickets\Concerns;
use Lumina\Tickets\Scopes\TicketScope;

/**
 * Lumina\Tickets\Models\Ticket
 *
 * @property string $uuid
 * @property int $user_id
 * @property string $title
 * @property string $message
 * @property string $status
 */
class Ticket extends Model
{
    use Concerns\InteractsWithTicketRelations;
    use Concerns\InteractsWithTickets;
    use HasFactory;
    use TicketScope;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get User RelationShip
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    /**
     * Get Messages RelationShip
     */
    public function messages(): HasMany
    {
        return $this->hasMany(
            Message::class,
            (string) 'ticket_id',
        );
    }

    /**
     * Get Categories RelationShip
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'category_ticket',
            'ticket_id',
            'category_id',
        );
    }

    /**
     * Get Members RelationShip
     */
    public function members(): HasMany
    {
        return $this->hasMany(
            Member::class,
            (string) 'ticket_id',
        );
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return 'tickets';
    }

    /**
     * Add a member to the ticket.
     */
    public function addMember(int $user_id): void
    {
        $member = new Member();
        $member->user_id = $user_id;
        $this->members()->save($member);
    }

    /**
     * Remove a member from the ticket.
     */
    public function removeMember(int $user_id): void
    {
        $this->members()->where('user_id', $user_id)->delete();
    }
}
