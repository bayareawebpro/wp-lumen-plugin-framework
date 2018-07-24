<?php namespace App\Providers;
use Illuminate\Support\ServiceProvider;
class DebugbarServiceProvider extends ServiceProvider
{
    protected $debugBar, $helper, $enabled, $assetRenderer;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->app = $app;
        $this->helper = $this->app->make('lumenHelper');
        $this->helper = $this->app->make('lumenHelper');
        $this->enabled = $this->helper->config('app.debug', false);
        $this->debugBar = null;
    }

    public function register()
    {
        if (!$this->enabled) return;
        /** @var $debugBar \DebugBar\DebugBar */
        $this->debugBar = $this->app->make('debugbar');

        /** @var $assetRenderer \DebugBar\JavascriptRenderer */
        $this->assetRenderer = $this->debugBar->getJavascriptRenderer();
        $this->assetRenderer->disableVendor('jquery');
        $this->assetRenderer->setEnableJqueryNoConflict(false);
    }

    public function boot()
    {
        if (!$this->enabled) return;

        if(defined( 'SAVEQUERIES')){
            $this->debugBar->addCollector(new \App\Helpers\DebugBarWordpressDbCollector());
        }else{
            $this->debugBar->addMessage('Add define("SAVEQUERIES") to wp-config.php to enable the WP Query Collector', 'WpLumen');
        }

        /** Include Debugbar Assets */
        $this->helper->wpHelper()
            ->addAction('admin_head', function() {
                $this->renderHeader();
            }, 1000)
            ->addAction('wp_head', function() {
                $this->renderHeader();
            }, 1000)
            ->addAction('admin_print_footer_scripts', function() {
                $this->renderFooter();
            }, 1000)
            ->addAction('wp_footer', function() {
                $this->renderFooter();
            }, 1000);
    }

    private function renderHeader()
    {
        $url = $this->helper->request()->url();
        $scheme = parse_url($url, PHP_URL_SCHEME).':';
        $urlBase = str_replace($scheme, '', $url);
        $assets = str_replace($urlBase.'/', '/', $this->assetRenderer->renderHead());
        echo $assets;
    }

    private function renderFooter()
    {
        echo $this->assetRenderer->render();
    }
}
