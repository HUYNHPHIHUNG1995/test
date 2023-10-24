<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\Language;

class AppServiceProvider extends ServiceProvider
{
    public $serviceBindings=[
        'App\Services\Interfaces\UserServiceInterface'=>'App\Services\UserService',
        'App\Repositories\Interfaces\UserRepositoryInterface' =>'App\Repositories\UserRepository',
        
        'App\Services\Interfaces\UserCatalogueServiceInterface'=>'App\Services\UserCatalogueService',
        'App\Repositories\Interfaces\UserCatalogueRepositoryInterface' =>'App\Repositories\UserCatalogueRepository',

        'App\Services\Interfaces\LanguageServiceInterface'=>'App\Services\LanguageService',
        'App\Repositories\Interfaces\LanguageRepositoryInterface' =>'App\Repositories\LanguageRepository',

        'App\Repositories\Interfaces\ProvinceRepositoryInterface' =>'App\Repositories\ProvinceRepository',
        'App\Repositories\Interfaces\DistrictRepositoryInterface' =>'App\Repositories\DistrictRepository',
        'App\Repositories\Interfaces\WardRepositoryInterface' =>'App\Repositories\WardRepository',
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->serviceBindings as $key=>$val)
        {
            $this->app->bind($key,$val);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('custom_unique_check', function($attribute, $value, $parameters, $validator){
            $className='App\Models\\'.$parameters[0];
            $record = $className::where([
                'deleted_at' => NULL,
                'canonical' => $value
            ])->first();
                //ko co du lieu thi tra ve true,co du lieu trong table tra ve false
            return (is_null($record)) ? true : false;
        });
    }
}
