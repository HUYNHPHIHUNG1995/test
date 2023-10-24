<?php


namespace App\Repositories;
use App\Models\Catalogue;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface;

class UserCatalogueRepository extends BaseRepository implements UserCatalogueRepositoryInterface
{
    protected $model;

    public function __construct(Catalogue $model)
    {
       $this->model=$model;
    }
    
    
}
