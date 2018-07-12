<?php namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Helpers\WpHelper;
use App\Helpers\LumenHelper;
use App\Models\JSON;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var $lumenHelper \App\Helpers\LumenHelper
     * @var $app \Laravel\Lumen\Application
     */
    protected $lumenHelper, $app;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->app = $app;
        $this->lumenHelper = null;
    }


    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        /** Set Default DB String Length **/
        $this->app
            ->make('db')
            ->connection()
            ->getSchemaBuilder()
            ->defaultStringLength(191);


        /** Register lumenHelper **/
        $this->app->singleton('lumenHelper', function(){
            return new LumenHelper($this->app);
        });
        $this->app->when(LumenHelper::class)
            ->needs('$app')
            ->give(function() {
                return $this->app;
            });

        /** Register WpHelper **/
        $this->app
            ->singleton('wpHelper', function(){
            return new WpHelper($this->app);
        });
        $this->app
            ->when(WpHelper::class)
            ->needs('$app')
            ->give(function() {
            return $this->app;
            });


        $this->lumenHelper = $this->app->make('lumenHelper');
        $this->lumenHelper->loadConfigurations();
        /** Register WpHelper **/
        $this->app
            ->singleton('settings', function(){
                return new JSON($this->lumenHelper, $this->lumenHelper->storage_path('settings.json'));
            });
        $this->app
            ->when(JSON::class)
            ->needs('$lumenHelper')
            ->give(function() {
                return $this->lumenHelper;
            });
    }

    /**
     * Boot application services.
     * @return void
     */
    public function boot() {


    }

    /**
     * Provide application services.
     * @return array
     */
    public function provides() {
        return ['lumenHelper', 'wpHelper'];
    }
}
