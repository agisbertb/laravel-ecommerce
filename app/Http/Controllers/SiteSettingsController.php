<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SiteSettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();

        $defaults = [
            'site_logo' => null,
            'footer_logo' => null,
            'facebook_url' => null,
            'instagram_url' => null,
            'twitter_url' => null,
            'youtube_url' => null,
        ];

        $settings = array_merge($defaults, $settings);

        if ($settings['site_logo']) {
            $settings['site_logo'] = Storage::url($settings['site_logo']);
        }
        if ($settings['footer_logo']) {
            $settings['footer_logo'] = Storage::url($settings['footer_logo']);
        }

        return Inertia::render('Welcome', [
            'siteSettings' => $settings,
        ]);
    }
}
