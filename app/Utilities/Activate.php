<?php namespace App\Utilities;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use App\Helpers\LumenHelper;

class Activate{

    private $app;

    /**
     * Class Initialization called by Hook
     * @return Activate
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
//    	$this->schema();
//    	$this->data();
    }

    /**
     * Activation Database Schema
     */
    public function schema()
    {
        global $wpdb;

        //Check Version of Database && Set Schema String Length
        if(!version_compare(mb_substr($wpdb->get_results( 'SELECT version() as version')[0]->version, 0, 6), '5.7.7') >= 0){
            Schema::defaultStringLength(191);
        }

	    //Add Session Table if Configured
	    if($this->app->config()->get('session.driver') == 'database'){
		    //Create Sessions Table
		    if(!Schema::hasTable($this->app->config()->get('session.table'))){
			    Schema::create($this->app->config()->get('session.table'), function (Blueprint $table) {
				    $table->string('id')->unique();
				    //$table->unsignedInteger('user_id')->nullable();
				    $table->string('ip_address', 45)->nullable();
				    $table->text('user_agent')->nullable();
				    $table->text('payload');
				    $table->integer('last_activity');
			    });
		    }
	    }

	    //Add Queue Table if Configured
	    if($this->app->config()->get('queue.default') == 'database'){
		    //Create Queue Table
		    if(!Schema::hasTable($this->app->config()->get('queue.connections.database.table'))){
			    Schema::create($this->app->config()->get('queue.connections.database.table'), function (Blueprint $table) {
				    $table->bigIncrements('id');
				    $table->string('queue');
				    $table->longText('payload');
				    $table->tinyInteger('attempts')->unsigned();
				    $table->unsignedInteger('reserved_at')->nullable();
				    $table->unsignedInteger('available_at');
				    $table->unsignedInteger('created_at');
				    $table->index(['queue', 'reserved_at']);
			    });

			    Schema::create($this->app->config()->get('queue.failed.table'), function (Blueprint $table) {
				    $table->bigIncrements('id');
				    $table->text('connection');
				    $table->text('queue');
				    $table->longText('payload');
				    $table->longText('exception');
				    $table->timestamp('failed_at')->useCurrent();
			    });
		    }
	    }

    }

    /**
     * Insert Activation Data
     */
    public function data()
    {

    }


}