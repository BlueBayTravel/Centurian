<?php

/*
* This file is part of Centurian.
*
* (c) Blue Bay Travel <developers@bluebaytravel.co.uk>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace BlueBayTravel\Centurian;

use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class CenturianServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig($this->app);
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function setupConfig(Application $app)
    {
        $source = realpath(__DIR__.'/../config/centurian.php');
        if ($app instanceof LaravelApplication && $app->runningInConsole()) {
            $this->publishes([$source => config_path('centurian.php')]);
        } elseif ($app instanceof LumenApplication) {
            $app->configure('centurian');
        }
        $this->mergeConfigFrom($source, 'centurian');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCenturian($this->app);
    }

    /**
     * Registers the weather class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerCenturian(Application $app)
    {
        $app->singleton('centurian', function ($app) {
            $client = new Client([
                'headers' => [
                    'content-type' => 'application/json',
                    'token'        => $app['config']['centurian']['token'],
                ],
            ]);

            return new Centurian($client, $app['config']);
        });

        $app->alias('centurian', Centurian::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'centurian',
            'centurian.release',
        ];
    }
}
