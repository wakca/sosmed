<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Handler\SlackHandler;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Schema::defaultStringLength(191);

        // $monolog = \Log::getMonolog();

        // $monolog->pushHandler($chromeHandler = new \Monolog\Handler\ChromePHPHandler());
        // $chromeHandler->setFormatter(new \Monolog\Formatter\ChromePHPFormatter());

        
        // $slackHandler->setFormatter(new \Monolog\Formatter\LineFormatter());
        
        // $monolog = \Log::getMonolog();
        // $slackHandler = new SlackHandler('xoxp-388788555586-389847560727-405460955347-81e84cd94881d34361a60a936dfb27b2', '#error_log_server', 'Monolog', true, null, \Monolog\Logger::DEBUG);
        // $monolog->pushHandler($slackHandler);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
