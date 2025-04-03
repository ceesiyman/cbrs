<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'phone_number',
        'role',
        'password',
        'image',
        'token',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'token',
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

    /**
     * Check if the user is a constructor
     */
    public function isConstructor(): bool
    {
        return $this->role === 'Constructor';
    }

    /**
     * Check if the user is a client
     */
    public function isClient(): bool
    {
        return $this->role === 'Client';
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skills');
    }

    public function experience()
    {
        return $this->hasMany(Experience::class)->orderBy('start_date', 'desc');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'constructor_id')->latest();
    }

    public function bids()
    {
        return $this->hasMany(WorkBid::class, 'user_id');
    }
}
