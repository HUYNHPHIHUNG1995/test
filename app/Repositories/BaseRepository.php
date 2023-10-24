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

    public function create($inputs=[])
    {
        $model=$this->model->create($inputs);
        //dd($inputs);die();
        return $model->fresh();
    }

    public function all(){
        return $this->model->all();
    }

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend=[],
        int $perpage=1,
        array $relations =[]
    ){
        // TODO: Implement pagination() method.
        $query=$this->model->select($column)
                    ->where(function ($query) use ($condition){
                        if(isset($condition['keyword']) && !empty($condition['keyword'])){
                            $query->where('name','LIKE','%'.$condition['keyword'].'%');
                        }
                        if(isset($condition['publish']) && $condition['publish'] != -1 )
                        {
                            $query->where('publish',$condition['publish']);
                        }
                    });
                    //count
        if(isset($relations) && !empty($relations)){
            foreach($relations as $relation)
            {
                $query->withCount($relation);
            }
        }
        if(!empty($join)){
            $query->join(...$join);
        }
        return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL').$extend['path']);

    }

    public function findById(int $id)
    {
        // TODO: Implement findById() method.
        return $this->model->findOrFail($id);
    }

    public function update(int $id, array $data = [])
    {
        // TODO: Implement update() method.
        $model=$this->findById($id);
        return $model->update($data);
    }

    public function updateByWhereIn(string $whereInField='', array $whereIn=[],array $payload=[])
    {
        return $this->model->whereIn($whereInField,$whereIn)->update($payload);
    }
    //xoa mem
    public function delete(int $id =0)
    {
        // TODO: Implement delete() method.
        $model=$this->findById($id);
        return $model->delete();
    }
    //xoa cung
    public function forceDelete($id = 0)
    {
        // TODO: Implement forceDelete() method.
        $model=$this->findById($id);
        return $model->forceDelete();
    }
}
