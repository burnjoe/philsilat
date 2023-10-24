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
     * Filtering search
     */
    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('venue', 'like', "%{$value}%")
            ->orWhere('status', 'like', "%{$value}%");
    }

    public function teams() : HasMany {
        return $this->hasMany(Team::class);
    }
    
    public function games() : HasMany {
        return $this->hasMany(Game::class);
    }
}
