<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Baris ini wajib ada untuk memanggil fungsi URL

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
        // Memaksa Laravel menggunakan HTTPS HANYA jika berada di server Production (VPS)
        // Agar saat Anda coding di lokal (Laragon) tanpa SSL, aplikasi tidak error.
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}