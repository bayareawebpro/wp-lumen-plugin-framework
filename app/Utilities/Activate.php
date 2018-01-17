<?php namespace App\Utilities;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class Activate extends  Migration{


    /**
     * Class Initialization called by Hook (Requires Static Method)
     * @return Activate
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
    	$this->schema();
		$this->data();
    }

    /**
     * Modify Database Schema
     */
    public function schema()
    {
//	    Artisan::call('migrate:install');
//	    Artisan::call('migrate');
    }

    /**
     * Insert Database Data
     */
    public function data()
    {

    }


}