<?php

namespace App;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Notifications\Notifiable;
use iVirtual\AdminTheme\Traits\AdminThemeUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, AdminThemeUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
