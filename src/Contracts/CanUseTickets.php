<?php

namespace Lumina\Tickets\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface CanUseTickets
{
    public function tickets(): HasMany;
}
