<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        \App\Repositories\Contracts\CategoryRepository::class => \App\Repositories\Eloquent\CategoryRepositoryEloquent::class,
        \App\Repositories\Contracts\CourseRepository::class => \App\Repositories\Eloquent\CourseRepositoryEloquent::class,
        \App\Repositories\Contracts\LessonRepository::class => \App\Repositories\Eloquent\LessonRepositoryEloquent::class,
        \App\Repositories\Contracts\ClassRepository::class => \App\Repositories\Eloquent\ClassRepositoryEloquent::class,
        \App\Repositories\Contracts\PromotionRepository::class => \App\Repositories\Eloquent\PromotionRepositoryEloquent::class,
        \App\Repositories\Contracts\UserRepository::class => \App\Repositories\Eloquent\UserRepositoryEloquent::class,
    ];

    /**AC
     * 
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->repositories as $interface => $class) {
            $this->app->singleton($interface, $class);
        }
    }
}
