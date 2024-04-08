<?php

declare(strict_types=1);

namespace App\Data;

class Budget
{
    /** @var CategoryGroup[] $groups */
    public readonly array $groups;

    public function __construct(
        array $groups
    )
    {
        $this->groups = $groups;
    }
}
