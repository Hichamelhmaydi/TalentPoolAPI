<?php

namespace App\Providers;

use App\Repositories\RepositoryInterface\AnnonceRepositoryInterface;
use App\Repositories\Repository\AnnonceRepository;
use Illuminate\Support\ServiceProvider; 

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AnnonceRepositoryInterface::class, AnnonceRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
