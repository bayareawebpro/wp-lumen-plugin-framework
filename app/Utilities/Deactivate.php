<?php namespace App\Utilities;
use App\Helpers\LumenHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class DeActivate{

	private $app;

    /**
     * Class Initialization called by Hook (Requires Static Method)
     * @return DeActivate
     */
    public static function init()
    {
        return new self();
    }

    /**
     * Class Constructor called by init()
     * Get instance of plugin using namespace & call methods
     */
    public function __construct()
    {
//    	$this->app = LumenHelper::plugin(__NAMESPACE__);
//        $this->schema();
//        $this->data();
    }

    /**
     * Modify Database Schema
     */
    public function schema()
    {
	    if($this->app->config()->get('session.enabled') && $this->app->config()->get('session.driver') == 'database'){
		    Schema::dropIfExists($this->app->config()->get('session.table'));
	    }

	    if($this->app->config()->get('cache.enabled') && $this->app->config()->get('cache.default') == 'database'){
		    Schema::dropIfExists($this->app->config()->get('cache.stores.database.table'));
	    }

	    if($this->app->config()->get('queue.enabled') && $this->app->config()->get('queue.default') == 'database'){
		    Schema::dropIfExists($this->app->config()->get('queue.connections.database.table'));
		    Schema::dropIfExists($this->app->config()->get('queue.failed.table'));
	    }
    }
    /**
     * Process Misc Data
     */
    public function data()
    {

    }
}