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

    /**
     * @var $lumenHelper \App\Helpers\LumenHelper
     * @var $wpHelper \App\Helpers\WpHelper
     * @var $request \Illuminate\Http\Request
     * @var $config \Illuminate\Config\Repository
     */
    protected $wpHelper, $lumenHelper, $config, $app, $request;

    /**
     * WordpressServiceProvider constructor.
     * @param $app \Illuminate\Contracts\Foundation\Application|\Laravel\Lumen\Application
     */
    public function __construct($app) {
        $this->app = $app;
        parent::__construct($app);
        $this->lumenHelper = $this->app->make('lumenHelper');
        $this->wpHelper = $this->lumenHelper->wpHelper();
        $this->config = $this->lumenHelper->config();
    }

    /**
     * Register the application router.
     * @return void
     */
    public function register()
    {
        if (!$this->app->runningInConsole()) {

            $this->app->router->group([
                'namespace' => 'App\Http\Controllers',
            ], function($router){
                require __DIR__ . '/../../routes/web.php';
            });

            add_action('init', function() {
                //Handle Request
                $response = $this->app->handle($this->lumenHelper->request()->capture());
                $response->sendHeaders();
                    //Send Response by Overwriting WP (eager)
                    if ($this->config->get('router.loading', 'eager') === 'eager') {
                        $this->sendResponse($response);
                    //Send Response on 404 (lazy)
                    } elseif (is_404()) {
                        add_action('template_redirect', function () use ($response) {
                            $this->sendResponse($response);
                        });
                    }
            });
        }
    }
    /**
     * Send the Application Response
     * @param $response \Illuminate\Http\Response
     * @return void
     */
    private function sendResponse($response) {
        if (!empty($response->content())) {
            $response->send();
            if(!is_admin()) {
                exit;
            }
        }
    }
}
