<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
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

    /**
     * Relationships
     */
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'profileable');
    }
}
