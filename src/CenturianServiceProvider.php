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

use BlueBayTravel\Centurian\Console\Commands\CenturianRelease;
use GuzzleHttp\Client;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application;
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
        $this->setupConfig();

        $this->commands('command.release');
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/centurian.php');

        if ($this->app instanceof Application && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('centurian.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('centurian');
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
        $this->registerCenturian();
        $this->registerCenturianReleaseCommand();
    }

    /**
     * Registers the weather class.
     *
     * @return void
     */
    protected function registerCenturian()
    {
        $this->app->singleton('centurian', function (Container $app) {
            $config = $app['config'];

            $client = new Client([
                'headers' => [
                    'content-type' => 'application/json',
                ],
            ]);

            return new Centurian($client, $config);
        });

        $this->app->alias('centurian', Centurian::class);
    }

    /**
     * Registers the weather class.
     *
     * @return void
     */
    protected function registerCenturianReleaseCommand()
    {
        $this->app->singleton('command.release', function (Container $app) {
            $centurian = $app['centurian'];

            return new CenturianRelease($centurian);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'command.release',
        ];
    }
}
