<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\JobRepositoryRepository;
use App\Entities\JobRepository;
use App\Validators\JobRepositoryValidator;

/**
 * Class JobRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class JobRepositoryRepositoryEloquent extends BaseRepository implements JobRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return JobRepository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
