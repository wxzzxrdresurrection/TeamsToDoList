<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{

    const TITLE = "title";
    const BODY = "body";
    const IS_COMPLETED = "is_completed";
    const COMPLETED_AT = "completed_at";
    const CREATED_BY = "created_by";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::TITLE,
        self::BODY,
        self::IS_COMPLETED,
        self::COMPLETED_AT,
        self::CREATED_BY
    ];

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
