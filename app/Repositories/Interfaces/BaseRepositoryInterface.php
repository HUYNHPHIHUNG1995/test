<?php


namespace App\Repositories\Interfaces;
//use App\Models\Base;

interface BaseRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function update(int $id,array $data=[]);
}
