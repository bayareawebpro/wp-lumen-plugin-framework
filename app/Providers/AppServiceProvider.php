<?php namespace App\Providers;
use App\Helpers\WpHelper;
use Illuminate\Support\ServiceProvider;
use App\Helpers\LumenHelper;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
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

    }

	public function boot()
	{
		foreach($this->app->make('files')->files(realpath(__DIR__.'/../../config/')) as $configFile){
			$this->app->configure($configFile->getBasename('.php'));
		}
	}
    public function provides() {
	    return ['lumenHelper', 'wpHelper'];
    }
}
