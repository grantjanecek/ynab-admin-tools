<?php

declare(strict_types=1);

namespace App\Data;

class CategoryGroup
{
    /** @var Category[] $categories */
    public readonly array $categories;

    public function __construct(
        public readonly string $name,
        array $categories,
    )
    {
        $this->categories = $categories;
    }
}
