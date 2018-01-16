<?php

namespace App\Http\Controllers;

use App\Traits\WpPageEnabled;
use Illuminate\Http\Request;

class ExampleAdminElementsController extends Controller
{
	use WpPageEnabled;
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    	$this->setPageTitle('Admin UI Kitchen Sink');
    }

    public function show(Request $request){

    	return view('admin.layouts.kitchen-sink');
    }
}
