<?php


namespace App\Repository\DrugsRepository;


interface DrugsRepositoryInterface
{
    public function getPaginated();
    public function whereIn($ids);
}
