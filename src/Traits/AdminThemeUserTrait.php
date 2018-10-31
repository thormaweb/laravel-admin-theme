<?php

namespace iVirtual\AdminTheme\Traits;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

trait AdminThemeUserTrait
{
    use HasMediaTrait, HasRoles;

    /**
     * Get Avatar Url
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->getFirstMediaUrl('avatar')) {
            return $this->getFirstMediaUrl('avatar', 'avatar');
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
        return $this->name;
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('avatar')
            ->fit(Manipulations::FIT_FILL, 512, 512)
            ->background('ffffff');
    }


}
