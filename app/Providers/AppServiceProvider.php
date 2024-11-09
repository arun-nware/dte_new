<?php

namespace App\Providers;

use App\Models\Navigation;
use App\Models\SiteSetting;
use App\Models\SupportDocumentType;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try{
            JsonResource::withoutWrapping();
            $siteSetting = SiteSetting::all()->first();
            if (isset($siteSetting->timezone) && $siteSetting->timezone != '') {
                config(['app.timezone' => $siteSetting->timezone]);
                date_default_timezone_set($siteSetting->timezone);
            }
            view()->share('siteSetting', $siteSetting);
            view()->share('navigations', Navigation::navigationList());
        }catch (\Exception $e){
            dd($e);
            logger($e->getMessage());
        }
    }
}
