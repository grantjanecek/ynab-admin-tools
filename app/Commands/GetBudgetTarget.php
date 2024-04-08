<?php

namespace App\Commands;

use App\Adapters\YnabAdapter;
use App\Services\YnabService;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

use function Termwind\{render};

class GetBudgetTarget extends Command
{
    protected $signature = 'get-budget-target';

    public function handle(YnabService $ynabService): void
    {
        $budget = $ynabService->getBudget();
        $total = 0;

        foreach ($budget->groups as $group){
           $this->title($group->name);

           $groupTotal = 0;
           $rows = [];
           foreach ($group->categories as $category){
               $budgetAmount = round($category->goalTarget / $category->goalMonthsToBudget / 1000, 2);
               $total += $budgetAmount;
               $groupTotal += $budgetAmount;
               $rows[] = [
                   $category->name,
                   '$'.number_format($budgetAmount, 2),
               ];
           }
           $rows[] = ['', ''];
           $rows[] = ['Total', '$'.number_format($groupTotal, 2)];

           $this->table(['Name', 'Amount'], $rows);
        }

        $this->title('Overview');

        $totalOutput = '$'.number_format($total, 2);
        $this->line("Total Budgeted: {$totalOutput}");
    }
}
