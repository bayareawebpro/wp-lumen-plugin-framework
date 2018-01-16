<?php namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Helpers\LumenHelper;
use Symfony\Component\HttpFoundation\Request;

class DebugbarServiceProvider extends ServiceProvider
{
	private $debugbar;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

	    $this->helper = $this->app->get('lumenHelper');

	    if (env('APP_DEBUG')) {
		    $this->app->register(\Barryvdh\Debugbar\LumenServiceProvider::class);
		    $this->debugbar = $this->app->makeWith('debugbar', array(
			    'request' =>Request::createFromGlobals(),
			    'response' =>$this->app->make('request')
		    ));
		    $this->debugbar->enable();
		    global $wpdb;
		    $this->debugbar->addCollector(new \App\Helpers\DebugBarWordpressDbCollector($wpdb));
	    }
    }
	private function renderHeader(){
		?>
		<style type="text/css">
			<?php $this->debugbar->getJavascriptRenderer()->dumpCssAssets(); ?>
		</style>
		<?
		echo $this->debugbar->getJavascriptRenderer()->renderHead();
	}

	private function renderFooter(){
		?>
		<script type="text/javascript">
			<?php $this->debugbar->getJavascriptRenderer()->dumpJsAssets(); ?>
		</script>
		<?
		echo $this->debugbar->getJavascriptRenderer()->render();
	}
	public function boot()
	{



		$this->helper->wpHelper()
			->addAction('admin_head', function(){
				$this->renderHeader();
			})
			->addAction( 'wp_head', function(){
				$this->renderHeader();
			})
			->addAction( 'admin_print_footer_scripts', function(){
				$this->renderFooter();
			})
			->addAction( 'wp_footer', function(){
				$this->renderFooter();
			});

	}
}
