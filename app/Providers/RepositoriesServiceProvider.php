<?php

namespace App\Providers;


use App\Repositories\ActivityTypeRepositoryInterface;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\CompanySectorRepositoryInterface;
use App\Repositories\Eloquent\ActivityTypeRepository;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\CompanySectorRepository;
use App\Repositories\Eloquent\RegionRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\Eloquent\SliderServiceRepository;
use App\Repositories\Eloquent\ContactUsRepository;
use App\Repositories\Eloquent\StaticPageRepository;
use App\Repositories\Eloquent\SubscribeRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\FaqsRepository;
use App\Repositories\Eloquent\RatingRepository;
use App\Repositories\Eloquent\FavouriteRepository;
use App\Repositories\Eloquent\NotificationRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\OrderItemRepository;
use App\Repositories\Eloquent\CustomOrderRepository;
use App\Repositories\Eloquent\CarRepository;
use App\Repositories\Eloquent\PackageRepository;


use App\Repositories\RegionRepositoryInterface;
use App\Repositories\NotificationRepositoryInterface;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\ContactUsRepositoryInterface;
use App\Repositories\SliderServiceRepositoryInterface;
use App\Repositories\StaticPageRepositoryInterface;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\SubscribeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\FaqsRepositoryInterface;
use App\Repositories\RatingRepositoryInterface;
use App\Repositories\FavouriteRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderItemRepositoryInterface;
use App\Repositories\CustomOrderRepositoryInterface;
use App\Repositories\CarRepositoryInterface;
use App\Repositories\PackageRepositoryInterface;

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
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(FaqsRepositoryInterface::class, FaqsRepository::class);
        $this->app->bind(RatingRepositoryInterface::class, RatingRepository::class);
        $this->app->bind(FavouriteRepositoryInterface::class, FavouriteRepository::class);
        $this->app->bind(StaticPageRepositoryInterface::class, StaticPageRepository::class);
        $this->app->bind(ActivityTypeRepositoryInterface::class, ActivityTypeRepository::class);
        $this->app->bind(RegionRepositoryInterface::class, RegionRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(CompanySectorRepositoryInterface::class, CompanySectorRepository::class);
        $this->app->bind(SubscribeRepositoryInterface::class, SubscribeRepository::class);
        $this->app->bind(SliderServiceRepositoryInterface::class, SliderServiceRepository::class);
        $this->app->bind(ContactUsRepositoryInterface::class, ContactUsRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
        $this->app->bind(CustomOrderRepositoryInterface::class, CustomOrderRepository::class);
        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);
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
