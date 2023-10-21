<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'event_id',
    ];


    public function athletes() : HasMany {
        return $this->hasMany(Athlete::class);
    }

    public function gameMatches() : HasMany {
        return $this->hasMany(GameMatch::class);
    }

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function event() : BelongsTo {
        return $this->belongsTo(Event::class);
    }
}
