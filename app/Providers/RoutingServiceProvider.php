<?php namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    /*
    |--------------------------------------------------------------------------
    | Load The Application Routes
    |--------------------------------------------------------------------------
    | Next we will include the routes file so that they can all be added to
    | the application. This will provide all of the URLs the application
    | can respond to, as well as the controllers that may handle them.
    */

    /** @var \App\Helpers\LumenHelper $lumenHelper **/
    /** @var \App\Helpers\WpHelper $wpHelper **/
    /** @var \Laravel\Lumen\Application $app **/

    protected $wpHelper, $lumenHelper, $config, $app;

    /**
     * WordpressServiceProvider constructor.
     * @param $app \Illuminate\Contracts\Foundation\Application
     */
    public function __construct( $app ) {
        parent::__construct( $app );
        $this->lumenHelper = $this->app->make('lumenHelper');
        $this->wpHelper = $this->lumenHelper->wpHelper();
        $this->config = $this->lumenHelper->config();
    }

    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        if (!$this->app->runningInConsole()) {
            add_action('init', function () {
                $request = \Illuminate\Http\Request::capture();
                if (!is_admin()) {
                    $this->app->router->group([
                        'namespace' => 'App\Http\Controllers',
                    ], function ($router) {
                        require __DIR__ . '/../../routes/web.php';
                    });

                    //Handle Request
                    $response = $this->app->handle($request);

                    //Send Response by Overwriting WP (eager)
                    if ($this->config->get('router.loading') === 'eager') {
                        if (!empty($response->content())) {
                            $response->sendHeaders();
                            $response->sendContent();
                            exit($response->status());
                        }
                        //Send Response on 404 (lazy)
                    } elseif (is_404()) {
                        //Send Response During Template Redirect
                        add_action('template_redirect', function () use ($request, $response) {
                            if (!empty($response->content())) {
                                $response->sendHeaders();
                                $response->sendContent();
                                exit($response->status());
                            }
                        });
                    }
                } else {
                    //Handle Request
                    $response = $this->app->handle($request);
                    if($response){
                        $response->sendHeaders();
                        $response->sendContent();
                    }
                }
            });
        }
    }

    /**
     * Boot application services.
     * @return void
     */
    public function boot() {

    }
}
