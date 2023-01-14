<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static Builder notAdmin()
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'is_on',
        'purchaser',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_on' => 'boolean',
        'purchaser' => 'boolean',
    ];

    protected $appends = [
        'full_name',
        'permission',
    ];

    public function getPermissionAttribute()
    {
        return [
            'operator' => $this->getRole('operator'),
            'manager' => $this->getRole('manager'),
            'admin' => $this->getRole('admin'),
        ];
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function scopeFullName()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function getRole($role): bool
    {
        return $this->role === $role || $this->role === 'admin' ? true : false;
    }

    public function isOn(): bool
    {
        return $this->is_on === true;
    }

    public function scopeIsOn(Builder $query): Builder
    {
        return $query->where('is_on', true);
    }
}
