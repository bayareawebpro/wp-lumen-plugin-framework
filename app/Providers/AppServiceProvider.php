<?php namespace App\Providers;
use App\Helpers\WpHelper;
use Illuminate\Support\ServiceProvider;
use App\Helpers\LumenHelper;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {

	    /** Register lumenHelper **/
	    $this->app->singleton('lumenHelper', LumenHelper::class);
	    $this->app->when(LumenHelper::class)
	              ->needs('$app')
	              ->give(function () {
		              return $this->app;
	              });

	    /** Register wpHelper **/
	    $this->app->singleton('wpHelper', WpHelper::class);
	    $this->app->when(WpHelper::class)
	              ->needs('$app')
	              ->give(function () {
		              return $this->app;
	              });

	    /** Load All Configurations (config/*.php) **/
	    $this->app->make('lumenHelper')->loadConfigurations();
    }

	/**
	 * Boot application services.
	 * @return void
	 */
	public function boot() {}

	/**
	 * Provide application services.
	 * @return array
	 */
    public function provides() {
	    return ['lumenHelper', 'wpHelper'];
    }
}
