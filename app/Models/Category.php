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
        'weight_min',
        'weight_max',
    ];


    public function games() : HasMany {
        return $this->hasMany(Game::class);
    }
}
