<?php

namespace App\Http\Controllers;

use App\Helpers\LumenHelper;
use App\Traits\WpPageEnabled;
use App\Vehicle;

class ExampleRouteThemeViewController extends Controller
{
	protected $helper, $vehicle;
	use WpPageEnabled;
    /**
     * Create a new controller instance.
     */
    public function __construct(LumenHelper $helper)
    {
    	$this->setPageTitle('Test Theme');
    	$this->helper = $helper;

    }

    public function show(){
    	return $this->helper->view('test-theme');
    }
}



