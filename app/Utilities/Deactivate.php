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
//    	$this->app = LumenHelper::plugin(__NAMESPACE__);
//        $this->schema();
//        $this->data();
    }

    /**
     * Modify Database Schema
     */
    public function schema()
    {

    }

    /**
     * Process Data
     */
    public function data()
    {

    }
}