<?php

namespace Lumina\Tickets\Tests\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Lumina\Tickets\Concerns\HasTickets;
use Lumina\Tickets\Contracts\CanUseTickets;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, CanUseTickets
{
    use Authenticatable,
        Authorizable,
        CanResetPassword,
        HasFactory,
        HasTickets,
        MustVerifyEmail;

    protected $guarded = [];
}
