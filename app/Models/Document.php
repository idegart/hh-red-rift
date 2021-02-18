<?php

namespace App\Models;

use App\Traits\PrimaryUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Document extends Model
{
    use PrimaryUUID;
    use HasFactory;

    protected $with = [
        'payload',
        'payload.meta',
        'payload.actions',
    ];

    public function payload(): HasOne
    {
        return $this->hasOne(Payload::class);
    }
}
