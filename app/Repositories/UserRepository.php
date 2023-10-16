<?php


namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
       $this->model=$model;
    }
    //mac dinh dc sd cua Base ,can viet rieng thi cau hinh lai khac di
    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend=[],
        int $perpage=1
    ){
        // TODO: Implement pagination() method.
        $query=$this->model->select($column)
                    ->where(function ($query) use ($condition){
                        if(isset($condition['keyword']) && !empty($condition['keyword'])){
                            $query->where('name','LIKE','%'.$condition['keyword'].'%')
                            ->orWhere('email','LIKE','%'.$condition['keyword'].'%')
                            ->orWhere('address','LIKE','%'.$condition['keyword'].'%')
                            ->orWhere('phone','LIKE','%'.$condition['keyword'].'%');
                        }
                        if(isset($condition['publish']) && $condition['publish'] != -1 )
                        {
                            $query->where('publish',$condition['publish']);
                        }
                    });


        if(!empty($join)){
            $query->join(...$join);
        }
        return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL').$extend['path']);

    }

}
