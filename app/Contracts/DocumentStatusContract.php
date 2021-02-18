<?php

namespace App\Contracts;

interface DocumentStatusContract
{
    public const DRAFT = 'draft';
    public const PUBLISHED = 'published';

    public const ALL = [
        self::DRAFT,
        self::PUBLISHED,
    ];
}