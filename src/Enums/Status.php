<?php

namespace Lumina\Tickets\Enums;

enum Status: string
{
    case OPEN = 'open';
    case CLOSED = 'closed';
    case LOCKED = 'locked';
}
