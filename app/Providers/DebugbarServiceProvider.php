<?php namespace App\Providers;
use Illuminate\Support\ServiceProvider;
class DebugbarServiceProvider extends ServiceProvider
{
	private $debugBar, $helper, $assetRenderer;

	public function __construct($app)
	{
		parent::__construct($app);

		$this->app = $app;
		$this->helper = $this->app->make('lumenHelper');
		$this->debugBar = null;
	}

    public function register()
    {
	    if(env('APP_DEBUG')) {
		    $this->app->alias('Debugbar', 'Barryvdh\Debugbar\Facade'); //optional
		    $this->app->register(\Barryvdh\Debugbar\LumenServiceProvider::class);
		    $this->app->configure('debugbar');
		    $this->debugBar = $this->app->makeWith('debugbar', array(
			    'request' => $this->helper->request(),
			    'response' => $this->helper->response()
		    ));

		    $this->debugBar->enable();

		    if(defined( 'SAVEQUERIES')){
			    $this->debugBar->addCollector(new \App\Helpers\DebugBarWordpressDbCollector());
		    }else{
			    $this->debugBar->addMessage('Add define("SAVEQUERIES") to wp-config.php to enable the WP Query Collector', 'WpLumen');
		    }

		    $this->app->singleton('debugbar', function(){
			    return  $this->debugBar;
		    });

	    }
    }

	public function boot()
	{
		if(env('APP_DEBUG')) {
			$this->helper->wpHelper()
			             ->addAction( 'admin_head', function () {
				             $this->renderHeader();
			             }, 100 )
			             ->addAction( 'wp_head', function () {
				             $this->renderHeader();
			             }, 100 )
			             ->addAction( 'admin_print_footer_scripts', function () {
				             $this->renderFooter();
			             }, 100 )
			             ->addAction( 'wp_footer', function () {
				             $this->renderFooter();
			             }, 100 );
		}
	}

	private function renderHeader(){
		$this->assetRenderer = $this->debugBar->getJavascriptRenderer(site_url(), '/');
		$this->assetRenderer->setEnableJqueryNoConflict(false);
		$this->assetRenderer->setIncludeVendors(true);
		$this->assetRenderer->disableVendor('jquery');
		?>
		<style type="text/css">
			<?php $this->assetRenderer->dumpCssAssets(); ?>
		</style>
		<?php
		echo $this->assetRenderer->renderHead();
	}
	private function renderFooter(){
		?>
		<script type="text/javascript">
			<?php $this->assetRenderer->dumpJsAssets(); ?>
		</script>
		<?php
		echo $this->assetRenderer->render();
	}
}
