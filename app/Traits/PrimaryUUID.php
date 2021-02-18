<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Trait PrimaryIsUUID
 * @package App\Traits
 * @mixin Model
 */
trait PrimaryUUID
{
    public static function bootPrimaryUUID(): void
    {
        self::creating(static function (self $model) {
            $model->{$model->getKeyName()} = (string) Uuid::uuid6();
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
