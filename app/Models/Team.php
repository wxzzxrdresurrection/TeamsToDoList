<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{

    const NAME = "name";
    const OWNER_ID = "owner_id";
    const DESCRIPTION = "description";
    const CODE = "code";
    const ICON = "icon";

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::NAME,
        self::OWNER_ID,
        self::DESCRIPTION,
        self::CODE,
        self::ICON
    ];

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function notes(): HasMany {
        return $this->hasMany(Note::class);
    }
}
