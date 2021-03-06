<?php

namespace Ree\Models;

use Illuminate\Auth\Authenticatable;
use Jenssegers\Mongodb\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Authenticatable,
        Authorizable,
        CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static function boot()
    {
        parent::boot();

        static::saving(function (User $user) {
            if ($user->isDirty('password')) {
                $user->attributes['password'] = \Hash::make(array_get($user->attributes, 'password'));
            }
        });
    }

    /**
     * Get the user avatar image url
     * 
     * @return string
     */
    public function getAvatarUrl()
    {
        $hash = md5(strtolower($this->email));
        return "http://www.gravatar.com/avatar/{$hash}";
    }
}
