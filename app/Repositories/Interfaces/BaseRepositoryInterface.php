<?php


namespace App\Repositories\Interfaces;
//use App\Models\Base;

interface BaseRepositoryInterface
{
    public function all();
    public function pagination(array $column = ['*'],
                               array $condition = [],
                               array $join = [],
                               array $extend=[],
                               int $perpage=20,
                               array $relations =[]);
    public function findById(int $id);
    public function update(int $id,array $data=[]);
    public function updateByWhereIn(string $whereInField='', array $whereIn=[], array $payload=[]);
    public function delete(int $id = 0);
    public function forceDelete($id = 0);
}
