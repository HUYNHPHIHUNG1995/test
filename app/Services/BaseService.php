<?php

namespace App\Services;

use App\Services\Interfaces\BaseServiceInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;

/**
 * Class UserService
 * @package App\Services
 */
class BaseService implements BaseServiceInterface
{
    
    public function __construct()
    {
        
    }
    public function currentLanguage()
    {
        return 1;
    }
}
