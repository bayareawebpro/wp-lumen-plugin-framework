<?php namespace App\Providers;
use Illuminate\Support\ServiceProvider;
class UtilityServiceProvider extends ServiceProvider
{

	/** @var \App\Helpers\LumenHelper $lumenHelper **/
	/** @var \App\Helpers\WpHelper $wpHelper **/

	private $wpHelper, $lumenHelper, $absolutePath;

	/**
	 * WordpressServiceProvider constructor.
	 * @param $app \Illuminate\Contracts\Foundation\Application
	 */
	public function __construct( $app ) {
		parent::__construct( $app );
		$this->lumenHelper = $this->app->make('lumenHelper');
		$this->wpHelper = $this->lumenHelper->wpHelper();
		$this->absolutePath = realpath(__DIR__.'/../../plugin.php');
	}

	/**
	 * Hook Schema Into Activate, DeActivate & UnInstall
	 * (Allows Schema Class Usage)
	 */
    public function boot(){
		register_activation_hook($this->absolutePath, array('\App\Utilities\Activate', 'init'));
		register_deactivation_hook($this->absolutePath, array('\App\Utilities\DeActivate', 'init'));
		register_uninstall_hook($this->absolutePath, array('\App\Utilities\UnInstall', 'init'));
    }
}
