<?php namespace App\Widgets;
use App\Helpers\LumenHelper;
use App\Models\WpPost;
use App\Widget;

class ExampleFrontEndWidget extends \WP_Widget {

	protected $helper,$post, $cache;

	function __construct(LumenHelper $helper, WpPost $post)
	{
		$this->helper = $helper;
		$this->post = $post;
		$this->cache = $this->helper->cache();
		parent::__construct(
			'wp_lumen_widget',
			'Lumen Widget',
			array(
				'classname' => 'wp_lumen_list_child_pages',
				'description' => 'List Child Pages for the current page',
			)
		);
	}

	public function form($instance)
	{
		echo '<p>Controls</p>'; //Expects at least one paragraph.
	}

	public function widget($args, $instance)
	{
		$request = $this->helper->request();
		$currentPost = $this->helper->wpHelper()->getGlobalPost();

		echo $this->helper->view('widgets.widget');
	}

	public function update( $new_instance, $old_instance ) {

		return $new_instance;
	}
}