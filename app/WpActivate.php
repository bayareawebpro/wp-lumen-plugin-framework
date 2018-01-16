<?php namespace App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
class WpActivate{

    private $plugin;

    /**
     * Class Initialization called by Hook
     * @return WpActivate
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
    }

    /**
     * Modify Database Schema
     */
    public function schema()
    {
        global $wpdb;
        //Check Version of Database
        if(!version_compare(mb_substr($wpdb->get_results( 'SELECT version() as version')[0]->version, 0, 6), '5.7.7') >= 0){
            //Set Schema String Length
            Schema::defaultStringLength(191);
        }

        //Add Session Table if Configured
        if($this->plugin['config']->get('session.enabled') && $this->plugin['config']->get('session.driver') == 'database'){
            //Create Sessions Table
            if(!Schema::hasTable('test')){
                Schema::create('test', function (Blueprint $table) {
                    $table->string('id')->unique();
                    $table->string('ip_address', 45)->nullable();
                    $table->text('user_agent')->nullable();
                    $table->text('payload');
                    $table->integer('last_activity');
                });
            }
        }

    }

    /**
     * Insert Starter Data
     */
    public function data()
    {

    }


}