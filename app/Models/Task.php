<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'notes',
        'finished',
    ];

    protected $casts =
        [
            'finished' => 'bool',
        ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
