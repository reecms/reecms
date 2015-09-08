<?php

namespace Ree\Models;

use Carbon\Carbon;
use Jenssegers\Mongodb\Model;
use Illuminate\Auth\Authenticatable;
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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['confirmed_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function(User $user) {
            if (array_get($user->attributes, 'token') === null) {
                $user->attributes['token'] = str_random(32);
            }
        });

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

    /**
     * Confirm this user account.
     * 
     * Set the `token` field to null and the `confirmed_at` field to
     * the current timestamp.
     * 
     * Model is not saved. The `save` method need calling to update the
     * physical database.
     * 
     * @return \Ree\Models\User
     */
    public function confirm()
    {
        if (!$this->exists) {
            $this->save();
        }
        $this->token        = null;
        $this->confirmed_at = Carbon::now();
        return $this;
    }
}
