<?php

declare(strict_types=1);

namespace App\Data;

class TableExport
{
    public function __construct(
        public readonly array $headers,
        public readonly array $rows,
    )
    {
    }
}
