<?php

namespace App\Providers;


use App\Repositories\ActivityTypeRepositoryInterface;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\CompanySectorRepositoryInterface;
use App\Repositories\Eloquent\ActivityTypeRepository;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\CompanySectorRepository;
use App\Repositories\Eloquent\RegionRepository;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\Eloquent\SliderServiceRepository;
use App\Repositories\Eloquent\ContactUsRepository;
use App\Repositories\Eloquent\StaticPageRepository;
use App\Repositories\Eloquent\SubscribeRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\RegionRepositoryInterface;
use App\Repositories\ContactUsRepositoryInterface;
use App\Repositories\SliderServiceRepositoryInterface;
use App\Repositories\StaticPageRepositoryInterface;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\SubscribeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register service.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(StaticPageRepositoryInterface::class, StaticPageRepository::class);
        $this->app->bind(ActivityTypeRepositoryInterface::class, ActivityTypeRepository::class);
        $this->app->bind(RegionRepositoryInterface::class, RegionRepository::class);
        $this->app->bind(CompanySectorRepositoryInterface::class, CompanySectorRepository::class);
        $this->app->bind(SubscribeRepositoryInterface::class, SubscribeRepository::class);
        $this->app->bind(SliderServiceRepositoryInterface::class, SliderServiceRepository::class);
        $this->app->bind(ContactUsRepositoryInterface::class, ContactUsRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);

    }

    /**
     * Bootstrap service.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
