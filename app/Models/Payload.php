<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payload extends Model
{
    use HasFactory;

    protected $hidden = [
        'id',
        'document_id',
        'created_at',
        'updated_at',
    ];

    public function meta(): HasOne
    {
        return $this->hasOne(Meta::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(Action::class);
    }
}
