<?php namespace App\Providers;
use App\Helpers\LumenHelper;
use Illuminate\Support\ServiceProvider;
class WordpressServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(){

    }

    public function boot(){

	    /** @var \App\Helpers\WpHelper $wpHelper **/
	    $wpHelper = $this->app->make('wpHelper');

	    /** @var \App\Helpers\LumenHelper $lumenHelper **/
	    $lumenHelper = $this->app->make('lumenHelper');


	    /** Add Plugin Links to Admin > Plugins Page Entry **/
	    $wpHelper
		    ->addPluginLinks(array(
		        '<a target="_blank" href="http://bayareawebpro.com">Developer</a>',
	        ));


	    /** Add FrontEnd Widget **/
	    $wpHelper
		    ->addWidget(
		    \App\Widgets\ExampleFrontEndWidget::class
	        );

	    /** Add Admin Bar Nodes **/
	    $wpHelper
		    ->addAdminBarNode(
			    false,
			    'lumen_bar_node2',
			    'Lumen Bar Node',
			    '#'
		    )->addAdminBarNode(
			    'lumen_bar_node2',
			    'lumen_bar_node2_child1',
			    'Node Child 1',
			    '#'
		    )->addAdminBarNode(
			    'lumen_bar_node2',
			    'lumen_bar_node2_child2',
			    'Node Child 2',
			    '#'
		    )->addAdminBarNode(
			    'lumen_bar_node2',
			    'lumen_bar_node2_child3',
			    'Node Child 2',
			    '#'
		    );

	    /** Add Shortcodes **/
	    $wpHelper
		    ->addShortcode(
			    'auth_register',
			    \App\Http\Controllers\Auth\RegisterShortcodeController::class
		    )
		    ->addShortcode(
			    'auth_login',
			    \App\Http\Controllers\Auth\LoginShortcodeController::class
		    );


	    /** Add MetaBoxes **/
	    $wpHelper
		    ->addMetaBox(
		    'example_meta_box',
		    'Example Meta Box',
			    function ($post, $metabox_attributes) use ($lumenHelper){
				    $lumenHelper
					    ->response($this->app->call( '\App\Http\Controllers\ExampleMetaBoxController@show', compact('post', 'metabox_attributes')))
					    ->sendContent();
			    },
		    'post',
		    'normal',
		    'default',
		    2
	        )
		    ->addAction(
		    	'save_post',
			    function ($post_id, $post, $update){
				    if($post->post_type == 'post') {
					    $this->app->make('cache')->flush();
					    $this->app->call('\App\Http\Controllers\ExampleMetaBoxController@save', compact( 'post_id', 'post', 'update' ));
				    }
			    },
			    10,
			    3
		    );


	    /** Add Nav Menu MetaBoxes **/
	    $wpHelper->addMetaBox(
		    'example_menu_meta_box',
		    'Wp-Lumen',
		    function ( $object, $arguments) use ($lumenHelper){
			    $lumenHelper
				    ->response($this->app->call( '\App\Http\Controllers\ExampleMetaBoxController@menuMetaBox', compact('object', 'arguments')))
				    ->sendContent();
		    },
		    'nav-menus',
		    'side',
		    'default',
		    2
	    );



	    /** Add Dashboard Widget **/
	    $wpHelper
		    ->addDashboardWidget(
				'example_admin_widget',
				'Example Admin Widget',
				function() use ($lumenHelper){
					$lumenHelper
						->response($this->app->call( '\App\Widgets\ExampleAdminWidget@template'))
						->sendContent();
				}
	        );

	    /** Add Dashboard Panels **/
	    $wpHelper
		    ->addAdminPanel(
				'lumen_page',
				'WP-Lumen',
				'WP-Lumen',
			    function() use ($lumenHelper){
				    $lumenHelper
					    ->response($this->app->call( '\App\Http\Controllers\ExampleAdminController@template'))
					    ->sendContent();
			    },
				'read'
	        )
			->addAdminSubPanel(
				'lumen_page',
				'lumen_sub_page',
				'WP-Lumen SubPage',
				'WP-Lumen SubPage',
				function() use ($lumenHelper){
					$lumenHelper
						->response($this->app->call( '\App\Http\Controllers\ExampleAdminController@template'))
						->sendContent();
				},
				'read'
			);


	    /** Add CSS & Scripts **/
	    $wpHelper
		    ->enqueueStyle(
			    'lumen',
			    $lumenHelper->asset('resources/assets/build/example.css'),
			    array(),
			    '1.0.0',
			    'all'
		    )
		    ->enqueueScript(
			    'lumen',
			    $lumenHelper->asset('resources/assets/build/example.js'),
			    array('jquery'),
			    '1.0.0',
			    true
		    );

    }
}
