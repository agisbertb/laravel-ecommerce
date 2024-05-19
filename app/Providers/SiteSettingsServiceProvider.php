<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SiteSettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
        View::share('siteSettings', $settings);
    }

    public function register()
    {
        //
    }
}
