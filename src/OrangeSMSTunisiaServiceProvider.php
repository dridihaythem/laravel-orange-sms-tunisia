<?php

namespace DridiHaythem\OrangeSMSTunisia;

use DridiHaythem\OrangeSMSTunisia\Services\OrangeSMSTunisiaService;
use Illuminate\Support\ServiceProvider;

class OrangeSMSTunisiaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'orange_sms_tunisia');

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/views', 'orange-sms-tunisia');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/config/config.php' => config_path('orange_sms_tunisia.php'),
            ], 'config');


            if (!class_exists('CreateOrangeSMSTunisiaLogTable')) {
                $this->publishes([
                    __DIR__ . '/database/migrations/create_orange_sms_log_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_orange_sms_log_table.php'),
                ], 'migrations');
            }
        }
    }
}
