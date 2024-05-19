<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default values (if any)
        DB::table('site_settings')->insert([
            ['key' => 'site_name', 'value' => 'My Site'],
            ['key' => 'footer_name', 'value' => 'Footer Name'],
            ['key' => 'seo_title', 'value' => 'Default SEO Title'],
            ['key' => 'seo_description', 'value' => 'Default SEO Description'],
            ['key' => 'seo_keywords', 'value' => 'keyword1, keyword2'],
            ['key' => 'canonical_url', 'value' => 'https://www.example.com'],
            ['key' => 'og_title', 'value' => 'Default OG Title'],
            ['key' => 'og_description', 'value' => 'Default OG Description'],
            ['key' => 'twitter_card', 'value' => 'summary'],
            ['key' => 'twitter_title', 'value' => 'Default Twitter Title'],
            ['key' => 'twitter_description', 'value' => 'Default Twitter Description'],
            ['key' => 'robots', 'value' => 'index, follow'],
            ['key' => 'author', 'value' => 'Author Name'],
            ['key' => 'facebook_url', 'value' => 'https://www.facebook.com'],
            ['key' => 'instagram_url', 'value' => 'https://www.instagram.com'],
            ['key' => 'twitter_url', 'value' => 'https://www.twitter.com'],
            ['key' => 'youtube_url', 'value' => 'https://www.youtube.com'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
}
