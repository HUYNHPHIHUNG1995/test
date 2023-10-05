<?php


namespace App\Repositories\Interfaces;
//use App\Models\Base;

interface BaseRepositoryInterface
{
    public function all();
    public function findById(int $id);
}
