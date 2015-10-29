<?php

namespace Ree\Providers;

use Illuminate\Support\ServiceProvider;
use Ree\Services\CocktailService;
use Ree\Theme\Contracts\ThemeConfiguration;

class CocktailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('asset_build', function ($expression) {
            return "<?php echo app(\\Ree\\Services\\CocktailService::class)->resolveBuildAsset{$expression} ?>";
        });

        \Blade::directive('asset_theme', function ($expression) {
            return "<?php echo app(\\Ree\\Services\\CocktailService::class)->resolveThemeAsset{$expression} ?>";
        });

        $this->app->make(ThemeConfiguration::class)->setThemeName('default');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CocktailService::class, function ($app) {
            return new CocktailService(public_path(), $app['url']);
        });
    }
}
