<?php namespace App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class DeActivate{

    protected $this;
    private $plugin;

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
        $this->schema();
        $this->data();
    }

    /**
     * Modify Database Schema
     */
    public function schema()
    {

    }
    /**
     * Process Misc Data
     */
    public function data()
    {

    }
}