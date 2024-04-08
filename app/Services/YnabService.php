<?php

declare(strict_types=1);

namespace App\Services;

use App\Adapters\YnabAdapter;
use App\Data\Budget;
use App\Data\Category;
use App\Data\CategoryGroup;

class YnabService
{
    public function __construct(private readonly YnabAdapter $ynabAdapter)
    {
    }

    public function getBudget(): Budget
    {
        $data = $this->ynabAdapter->getCategories();
        ray($data);

        $categoryGroupsArr = $data['data']['category_groups'];

        $categoryGroups= [];
        foreach($categoryGroupsArr as $categoryGroupArr){

            if(in_array($categoryGroupArr['id'], config('ynab.hidden_category_ids'), true)){
                continue;
            }

            $categoriesArr = $categoryGroupArr['categories'];

            $categories = [];
            foreach($categoriesArr as $categoryArr){
                if($categoryArr['goal_target'] > 0 && $categoryArr['goal_months_to_budget'] > 0){
                    $categories[] = new Category(
                        name: $categoryArr['name'],
                        goalTarget: $categoryArr['goal_target'] ?? 0,
                        goalMonthsToBudget: $categoryArr['goal_months_to_budget'] ?? 0,
                    );
                }
            }

            if(! empty($categories)){
                $categoryGroups[] = new CategoryGroup($categoryGroupArr['name'], $categories);
            }
        }

        return new Budget($categoryGroups);
    }
}
