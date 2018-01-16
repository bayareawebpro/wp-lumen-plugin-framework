<?php namespace App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
class WpUnInstall{

    protected $this;

    /**
     * Class Initialization called by Hook (Requires Static Method)
     * @return WpUnInstall
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
     * Modify Database Schema
     */
    private function schema()
    {


    }

    /**
     * Remove Misc Data
     */
    private function data()
    {

    }
}