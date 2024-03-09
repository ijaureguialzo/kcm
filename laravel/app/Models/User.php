<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, HasLocalePreference
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function feeds()
    {
        return $this->hasMany(Feed::class);
    }

    public function owned_repositories()
    {
        return $this->hasMany(Repository::class);
    }

    public function subscribed_repositories()
    {
        return $this
            ->belongsToMany(Repository::class)
            ->withTimestamps()
            ->withPivot([
                'role_id',
            ]);
    }

    public function compilations()
    {
        return $this->hasManyThrough(Compilation::class, Repository::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function preferredLocale(): string
    {
        return $this->profile?->locale ?: config('app.fallback_locale');
    }
}

