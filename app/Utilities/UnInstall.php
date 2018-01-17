<?php namespace App\Utilities;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
class UnInstall{

    protected $this;

    /**
     * Class Initialization called by Hook (Requires Static Method)
     * @return UnInstall
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
        $this->schema();
        $this->data();
    }

    /**
     * Remove Database Schema
     */
    private function schema()
    {

//	    Artisan::call('migrate:rollback');
//	    Schema::dropIfExists('wp_migrations');

    }

    /**
     * Remove Data
     */
    private function data()
    {

    }
}