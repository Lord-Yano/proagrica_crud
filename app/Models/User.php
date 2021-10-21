<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** Uncomment this should you wish to not use fortify built in method
     *  // Hashing passwords from create user form using a mutator setPasswordAttribute
     *   public function setPasswordAttribute($password)
     *   {
     *  $this->attributes['password'] = Hash::make($password);
     *   }
     */

    // making user model know that it belongs to a M:M relationship so that laravel eloquent knows how to retrieve data
    public function roles()
    {
        return $this->belongsToMany(related: 'App\Models\Role');
    }

    // Check if user has role we are checking for
    public function hasAnyRole($role)
    {

        // returns null if there is no role | this current user's roles where name column has role | check if first part matches
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     *  Check if user has any given roles
     *  @param array $role
     *  @return bool
     */

    public function hasAnyRoles($role)
    {

        // returns null if there is no role | this current user's roles where name column has role | check if first part matches
        return null !== $this->roles()->whereIn('name', $role)->first();
    }
}
