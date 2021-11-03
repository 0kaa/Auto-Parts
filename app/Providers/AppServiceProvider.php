<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {

            $settingrepository = \App::make('App\Repositories\SettingRepositoryInterface');

            $instagram = $settingrepository->getwhere(['key' => 'instagram'])->first();
            $snapchat  = $settingrepository->getwhere(['key' => 'snapchat'])->first();
            $facebook  = $settingrepository->getwhere(['key' => 'facebook'])->first();
            $twitter   = $settingrepository->getwhere(['key' => 'twitter'])->first();
            $website   = $settingrepository->getwhere(['key' => 'website'])->first();

            view()->share([

                'instagram'  => $instagram,
                'snapchat'   => $snapchat,
                'facebook'   => $facebook,
                'twitter'    => $twitter,
                'website'    => $website,

            ]);  // end of view share

        });  // end of view composer

    }
}
