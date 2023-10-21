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
        'full_address',
        'barangay',
        'city',
        'province',
    ];

    
    public function teams() : HasMany {
        return $this->hasMany(Team::class);
    }
    
    public function games() : HasMany {
        return $this->hasMany(Game::class);
    }
}
