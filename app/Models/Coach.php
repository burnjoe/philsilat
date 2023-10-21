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

    
    public function user() : MorphOne {
        return $this->morphOne(User::class, 'profileable');
    }

    public function teams() : BelongsToMany {
        return $this->belongsToMany(Team::class);
    }
}
