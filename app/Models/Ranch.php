<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ranch extends Model
{
    protected $fillable = [
        'name',
        'state',
        'lga',
        'owner_name',
        'phone',
        'capacity',
        'latitude',
        'longitude',
        'status',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];
}
