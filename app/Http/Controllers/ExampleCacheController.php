<?php namespace App\Http\Controllers;

use App\Helpers\LumenHelper;

class ExampleCacheController extends Controller
{
	protected $helper, $cache;

    /**
     * Create a new controller instance.
     */
    public function __construct(LumenHelper $helper)
    {
	    $this->helper = $helper;
	    $this->cache = $this->helper->cache();
    }

    public function show(){

	    if(!$this->cache->has('test')){
		    $this->cache->put('test', 'Hello World! I am cached.', 60);
	    }

	    echo $this->cache->get('test');
    }
}
