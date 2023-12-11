<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'sex',
        'phone',
    ];


    /**
     * Filtering search
     */
    public function scopeSearch($query, $value)
    {
        $query->where('last_name', 'like', "%{$value}%")
            ->orWhere('first_name', 'like', "%{$value}%")
            ->orWhere('sex', 'like', "%{$value}%")
            ->orWhere('phone', 'like', "%{$value}%");
    }

    public function scopeSex($query, $array)
    {
        $query->whereIn('sex', $array);
    }

    /**
     * Relationships
     */
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'profileable');
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'coaches_teams', 'coach_id', 'team_id');
    }
}
