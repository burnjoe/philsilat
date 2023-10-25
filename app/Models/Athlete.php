<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'birthdate',
        'sex',
        'weight',
        'school_name',
        'grade_level',
        'lrn',
        'game_id',
        'team_id',
    ];


    /**
     * Filtering search
     */
    public function scopeSearch($query, $value)
    {
        $query->where('last_name', 'like', "%{$value}%")
            ->orWhere('first_name', 'like', "%{$value}%")
            ->orWhere('weight', 'like', "%{$value}%")
            ->orWhere('school_name', 'like', "%{$value}%")
            ->orWhere('grade_level', 'like', "%{$value}%")
            ->orWhere('lrn', 'like', "%{$value}%");
    }

    /**
     * Relationships
     */
    public function gameMatches(): HasMany
    {
        return $this->hasMany(GameMatch::class, 'athlete1_id', 'id')
            ->orWhere('athlete2_id', $this->getKey())
            ->orWhere('winner_id', $this->getKey());
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
