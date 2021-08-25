<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function scopeByUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
