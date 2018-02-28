<?php

namespace iVirtual\AdminTheme\Traits;

use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

trait AdminThemeUserTrait
{
    use HasMediaTrait, HasRoles;

    static $IMAGES_PATH = 'avatars';

    /**
     * Get Avatar Url
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->getFirstMediaUrl('images')) {
            return $this->getFirstMediaUrl('images', 'avatar');
        }

        return url(config('admin-theme.avatar'));
    }

    /**
     * Get Role's id's
     */
    public function getRoleIdsAttribute()
    {
        return $this->roles()->pluck('id')->toArray();
    }

    /**
     * Get the user's full name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFullNameAttribute($value)
    {
        return $this->getFullName();
    }

    /**
     * Return the full name of the user.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->name;
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('avatar')
            ->fit(Manipulations::FIT_FILL, 512, 512)
            ->background('ffffff');

    }


}