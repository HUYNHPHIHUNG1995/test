<?php


namespace App\Repositories;
//use App\Models\Base;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
class BaseRepository implements BaseRepositoryInterface
{
    protected $model; //cac class extend abstract nay se dinh nghia cu the model nay
    public function __construct(
        Model $model //model abstract
    )
    {
        $this->model=$model;
    }

    public function all(){
        return $this->model->all();
    }

    public function findById(int $id)
    {
        // TODO: Implement findById() method.
        return $this->model->findOrFail($id);
    }
}
