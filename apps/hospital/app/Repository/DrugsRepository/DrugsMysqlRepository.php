<?php


namespace App\Repository\DrugsRepository;


use App\Models\Drug;

class DrugsMysqlRepository implements DrugsRepositoryInterface
{
    public function getPaginated()
    {
        return Drug::paginate(config('pagination.large'));
    }

    public function whereIn($ids)
    {
        return Drug::whereIn('id', $ids)
            ->get();
    }
}
