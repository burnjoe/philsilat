<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignUpCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'role',
    ];


    /**
     * Data filters
     */
    public function scopeSearch($query, $value) {
        $query->where('id', 'like', "%{$value}%")
            ->orWhere('code', 'like', "%{$value}%")
            ->orWhere('role', 'like', "%{$value}%");
    }

    public function scopeRole($query, $array)
    {
        $query->whereIn('role', $array);
    }
}
