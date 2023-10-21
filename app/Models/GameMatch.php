<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'athlete1_id',
        'athlete2_id',
        'game_id',
        'winner_id',
    ];


    public function athlete1() : BelongsTo {
        return $this->belongsTo(Athlete::class, 'athlete1_id', 'id');
    }

    public function athlete2() : BelongsTo {
        return $this->belongsTo(Athlete::class, 'athlete2_id', 'id');
    }

    public function winner() : BelongsTo {
        return $this->belongsTo(Athlete::class, 'winner_id', 'id');
    }

    public function game() : BelongsTo {
        return $this->belongsTo(Game::class);
    }
}
