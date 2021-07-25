<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
{
    /**
     * Somehow PHP is not able to write in default /tmp directory and SwiftMailer was failing.
     * To overcome this situation, we set the TMPDIR environment variable to a new value.
     */
    if (class_exists('Swift_Preferences')) {
        \Swift_Preferences::getInstance()->setTempDir(storage_path().'/tmp');
    } else {
        \Log::warning('Class Swift_Preferences does not exists');
    }
}
/*    public function boot()
    {

		view()->composer('*', function($view){
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('view_name', $view_name);
        });

        
		}
}
*/