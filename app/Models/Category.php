<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_label',
        'sex',
        'min_weight',
        'max_weight',
    ];


    /**
     * Filtering search
     */
    public function scopeSearch($query, $value)
    {
        $query->where('class_label', 'like', "%{$value}%")
            ->orWhere('sex', 'like', "%{$value}%")
            ->orWhere('min_weight', 'like', "%{$value}%")
            ->orWhere('max_weight', 'like', "%{$value}%");
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
