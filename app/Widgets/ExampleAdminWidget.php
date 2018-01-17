<?php namespace App\Widgets;
use App\Helpers\LumenHelper;

class ExampleAdminWidget {

	protected $helper;

	function __construct(LumenHelper $helper) {
		$this->helper = $helper;
	}

	public function template(){
		return $this->helper->view('widgets.widget');
	}
}