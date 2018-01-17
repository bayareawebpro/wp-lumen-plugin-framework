<?php namespace App\Providers;
use Illuminate\Support\ServiceProvider;
class DebugbarServiceProvider extends ServiceProvider
{
	private $debugbar, $helper;

	public function __construct($app)
	{
		$this->app = $app;
		$this->helper = $this->app->make('lumenHelper');
		$this->debugbar = null;
	}

    public function register()
    {
	    if (env('APP_DEBUG')) {
		    $this->app->register(\Barryvdh\Debugbar\LumenServiceProvider::class);

		    $this->debugbar = $this->app->makeWith('debugbar', array(
			    'request' => $this->helper->request(),
			    'response' => $this->helper->response()
		    ));
		    
		    $this->debugbar->enable();

		    if(defined( 'SAVEQUERIES')){
			    $this->debugbar->addCollector(new \App\Helpers\DebugBarWordpressDbCollector());
		    }else{
			    $this->debugbar->addMessage('Add define("SAVEQUERIES") to wp-config.php to enable the WP Query Collector', 'WpLumen');
		    }

		    $this->app->singleton('debugbar', function(){
		    	return  $this->debugbar;
			});

	    }
    }
	private function renderHeader(){
		$this->debugbar->getJavascriptRenderer()->setEnableJqueryNoConflict(false)

		?>
		<style type="text/css">
			<?php $this->debugbar->getJavascriptRenderer()->dumpCssAssets(); ?>
		</style>
		<? echo $this->debugbar->getJavascriptRenderer()->renderHead();
	}
	private function renderFooter(){
		?>
		<script type="text/javascript">
			<?php $this->debugbar->getJavascriptRenderer()->dumpJsAssets(); ?>
		</script>
		<? echo $this->debugbar->getJavascriptRenderer()->render();
	}
	public function boot()
	{

		$this->helper->wpHelper()
			->addAction('admin_head', function(){
				$this->renderHeader();
			}, 100)
			->addAction( 'wp_head', function(){
				$this->renderHeader();
			}, 100)
			->addAction( 'admin_print_footer_scripts', function(){
				$this->renderFooter();
			}, 100)
			->addAction( 'wp_footer', function(){
				$this->renderFooter();
			}, 100);

	}
}
