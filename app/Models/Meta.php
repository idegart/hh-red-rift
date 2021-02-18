<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'color',
    ];

    protected $hidden = [
        'id',
        'payload_id',
        'created_at',
        'updated_at',
    ];
}
