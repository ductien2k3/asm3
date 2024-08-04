<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected $services = [
        \App\Services\Contracts\CategoryServiceInterface::class => \App\Services\Web\CategoryService::class,
        \App\Services\Contracts\CourseServiceInterface::class => \App\Services\Web\CourseService::class,
        \App\Services\Contracts\LessonServiceInterface::class => \App\Services\Web\LessonService::class,
        \App\Services\Contracts\ClassServiceInterface::class => \App\Services\Web\ClassService::class,
        \App\Services\Contracts\PromotionServiceInterface::class => \App\Services\Web\PromotionService::class,
        \App\Services\Contracts\UserServiceInterface::class => \App\Services\Web\UserService::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->services as $interface => $class) {
            $this->app->singleton($interface, $class);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
