<?php

namespace iVirtual\AdminTheme\Traits;

// use iVirtual\Images\Traits\ImagesTrait;
// use Laratrust\Traits\LaratrustUserTrait;

trait AdminThemeUserTrait
{
    use ImagesTrait,
        LaratrustUserTrait;

    static $IMAGES_PATH = 'avatars';

    /**
     * Get Avatar Url
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->featuredImage()->exists()) {
            return url($this->featuredImage->path);
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

}