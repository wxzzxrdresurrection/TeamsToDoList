<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    const TITLE = "title";
    const BODY = "body";
    const IS_COMPLETED = "is_completed";
    const COMPLETED_AT = "completed_at";
    const CREATED_BY = "created_by";
    const RESPONSIBLE_ID = "responsible_id";
    CONST TEAM_ID = "team_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::TITLE,
        self::BODY,
        self::RESPONSIBLE_ID,
        self::TEAM_ID,
        self::IS_COMPLETED,
        self::COMPLETED_AT,
        self::CREATED_BY
    ];

    protected function casts(): array
    {
        return [
            self::IS_COMPLETED => 'boolean',
            self::COMPLETED_AT => 'datetime'
        ];
    }

    public function responsible(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo {
        return $this->belongsTo(Team::class);
    }

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class);
    }

}
