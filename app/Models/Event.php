<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'host_name',
        'name',
        'description',
        'registration_starts_at',
        'registration_ends_at',
        'starts_at',
        'ends_at',
        'venue',
        'address',
        'barangay',
        'city',
        'province',
        'status',
    ];


    /**
     * Data filters
     */
    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('venue', 'like', "%{$value}%");
    }

    public function scopeStatus($query, $array)
    {
        $query->whereIn('status', $array);
    }

    /**
     * Relationships
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
