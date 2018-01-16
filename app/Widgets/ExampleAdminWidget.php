<?php namespace App\Widgets;
use App\Helpers\LumenHelper;

class ExampleAdminWidget {

	protected $helper, $widget_attributes;

	function __construct(LumenHelper $helper, $widget_attributes) {
		$this->helper = $helper;
		$this->widget_attributes = $widget_attributes;
		$this->show();
	}
	public function show(){
		echo $this->helper->view('widgets.admin-widget');
	}
}