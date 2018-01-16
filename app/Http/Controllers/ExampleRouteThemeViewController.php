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
    public function __construct(LumenHelper $helper, Vehicle $vehicle)
    {
    	$this->setPageTitle('Test Theme');
    	$this->helper = $helper;
    	$this->vehicle = $vehicle;

    }

    public function show(){



//		$vehicles = $this->helper->cache()->remember('vehicles', 10080, function(){
//			return $this->vehicle->getVehiclesFromAPI();
//		});
//
//
//		dd($vehicles->pluck('Make'));
//
//	    dd($vehicles->where('Make', 'Acura')->first()->get('Models')->sort());

    	return view('test-theme');
    }
}



