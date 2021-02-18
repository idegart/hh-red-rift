<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'actor',
    ];

    protected $hidden = [
        'id',
        'payload_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
