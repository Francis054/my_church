<?php

namespace App\Providers;

use App\Interfaces\ChurchInterface;
use App\Interfaces\DuesInterface;
use App\Interfaces\DuesPaymentInterface;
use App\Interfaces\MemberInterface;
use App\Interfaces\UserInterface;
use App\Models\DuesPayment;
use App\Repositories\ChurchRepository;
use App\Repositories\DuesPaymentRepository;
use App\Repositories\DuesRepository;
use App\Repositories\MemberRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ChurchInterface::class, ChurchRepository::class);
        $this->app->bind(MemberInterface::class, MemberRepository::class);
        $this->app->bind(DuesInterface::class, DuesRepository::class);
        $this->app->bind(DuesPaymentInterface::class, DuesPaymentRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
