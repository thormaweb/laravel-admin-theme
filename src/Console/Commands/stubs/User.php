<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use iVirtual\AdminTheme\Traits\AdminThemeUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class User extends Authenticatable implements HasMediaConversions
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
