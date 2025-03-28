<?php

namespace App\Providers;

use App\Repositories\RepositoryInterface\AnnonceRepositoryInterface;
use App\Repositories\Repository\AnnonceRepository;
use Illuminate\Support\ServiceProvider; 
use App\Repositories\RepositoryInterface\CondidateurRepositoryInterface;
use App\Repositories\Repository\CondidateurRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AnnonceRepositoryInterface::class, AnnonceRepository::class);
        $this->app->bind(CondidateurRepositoryInterface::class, CondidateurRepository::class);

    }

    public function boot(): void
    {
        //
    }
}