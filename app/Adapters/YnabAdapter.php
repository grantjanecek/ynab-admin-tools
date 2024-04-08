<?php

declare(strict_types=1);

namespace App\Adapters;

use Illuminate\Support\Facades\Http;

class YnabAdapter
{
    public function getCategories()
    {
        $budgetId = config('ynab.budget_id');
        $uri = "https://api.ynab.com/v1/budgets/{$budgetId}/categories";
        $token = config('ynab.token');

        return Http::withToken($token)
            ->get($uri)
            ->json();
    }
}
