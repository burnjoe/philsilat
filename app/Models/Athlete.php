<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * Data filters
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

    public function scopeNoMatchesInSameGame($query, $gameId)
    {
        $query->where('game_id', $gameId)
            ->whereDoesntHave('gameMatches');
    }

    public function scopeWinnersOfSameRound($query, $gameId, $round)
    {
        $query->whereHas('winningGameMatches', function ($subquery) use ($gameId, $round) {
            $subquery->where('game_id', $gameId)
                ->where('round', $round);
        });
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

    public function winningGameMatches(): HasMany
    {
        return $this->hasMany(GameMatch::class, 'winner_id', 'id');
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
