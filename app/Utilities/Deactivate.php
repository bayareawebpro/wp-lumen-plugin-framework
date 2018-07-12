<?php namespace App\Utilities;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
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
     */
    public function __construct()
    {
        $this->app = \App\Helpers\LumenHelper::plugin('App')->config();
        $this->schema();
        $this->data();
    }

    /**
     * Modify Database Schema
     */
    public function schema()
    {
        if(config('session.driver') === 'database') {
            Artisan::call('migrate:rollback');
            Schema::dropIfExists(config('session.table'));
        }
    }

    /**
     * Process Data
     */
    public function data()
    {

    }
}