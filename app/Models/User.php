<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    const EMAIL = "email";
    const PASSWORD = "password";
    const USERNAME = "username";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::EMAIL,
        self::PASSWORD,
        self::USERNAME
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::PASSWORD,
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            self::PASSWORD => 'hashed',
        ];
    }

    public function teams(): BelongsToMany {
        return $this->belongsToMany(Team::class, 'user_teams');
    }

    public function createdNotes() : HasMany {
        return $this->hasMany(Task::class);
    }

    public function responsibleNotes(): HasMany {
        return $this->hasMany(Task::class);
    }
}
