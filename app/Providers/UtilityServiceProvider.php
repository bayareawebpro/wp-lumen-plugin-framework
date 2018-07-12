<?php namespace App\Providers;
use App\Utilities\Activate;
use App\Utilities\DeActivate;
use App\Utilities\UnInstall;
use Illuminate\Support\ServiceProvider;
class UtilityServiceProvider extends ServiceProvider
{

	/** @var \App\Helpers\LumenHelper $lumenHelper **/
	/** @var \App\Helpers\WpHelper $wpHelper **/

    protected $wpHelper, $lumenHelper, $pluginPath;

	/**
	 * WordpressServiceProvider constructor.
	 * @param $app \Illuminate\Contracts\Foundation\Application
	 */
	public function __construct( $app ) {
		parent::__construct( $app );
		$this->lumenHelper = $this->app->make('lumenHelper');
		$this->wpHelper = $this->lumenHelper->wpHelper();
		$this->pluginPath = $this->lumenHelper->base_path($this->lumenHelper->config('app.plugin_file'));
	}
    /**
     * Register any application services.
     * @return void
     */
    public function register(){
        register_activation_hook($this->pluginPath, array('\App\Utilities\Activate', 'init'));
        register_deactivation_hook($this->pluginPath, array('\App\Utilities\DeActivate', 'init'));
        register_uninstall_hook($this->pluginPath, array('\App\Utilities\UnInstall', 'init'));
    }
	/**
	 * Hook Schema Into Activate, DeActivate & UnInstall
	 * (Allows Schema Class Usage)
	 */
    public function boot(){
    }
}
