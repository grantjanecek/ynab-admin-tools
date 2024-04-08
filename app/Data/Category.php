<?php

declare(strict_types=1);

namespace App\Data;

class Category
{
    public function __construct(
        public readonly string $name,
        public readonly int $goalTarget,
        public readonly int $goalMonthsToBudget,
    )
    {
    }
}
