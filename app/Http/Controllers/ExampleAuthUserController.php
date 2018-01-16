<?php namespace App\Http\Controllers;

use App\Helpers\LumenHelper;

class ExampleAuthUserController extends Controller
{
	protected $helper, $request, $auth;

    /**
     * Create a new controller instance.
     */
    public function __construct(LumenHelper $helper)
    {
	    $this->helper = $helper;
	    $this->request = $this->helper->request();
	    $this->auth = $this->helper->auth();
    }

    public function show(){

	    echo ('<p>Hello '.$this->auth->user()->display_name .'</p>');
	    echo ('<p>Hello '.$this->request->user()->display_name .'</p>');

    }
}
