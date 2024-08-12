<?php

namespace App\Providers;

use App\Events\PostCreated;
use App\Events\UserRegister;
use App\Listeners\SendEmailForRegister;
use App\Listeners\SendEmailToUser;
use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{


    /**
     * Register any application services.
     */
    public function register(): void
    {

    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            PostCreated::class,
            SendEmailToUser::class,
        );
        Event::listen(
            UserRegister::class,
            SendEmailForRegister::class,
        );

    }
}
