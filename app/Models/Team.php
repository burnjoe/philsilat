<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    /**
     * Filtering search
     */
    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%");
    }

    public function athletes(): HasMany
    {
        return $this->hasMany(Athlete::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function coaches(): BelongsToMany
    {
        return $this->belongsToMany(Coach::class);
    }
}
