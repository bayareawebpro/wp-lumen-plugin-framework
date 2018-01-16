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
    public function register()
    {

	    /** Register wpHelper **/
	    $this->app->singleton('wpHelper', function(){
	    	return new \App\Helpers\WpHelper($this->app);
	    });

    }

    public function boot(){

	    /** @var \App\Helpers\WpHelper $wpHelper **/
	    $wpHelper = $this->app->make('wpHelper');

	    /** Add Plugin Links to Admin > Plugins Page Entry **/
	    $wpHelper
		    ->addPluginLinks(array(
		        '<a target="_blank" href="http://bayareawebpro.com">Developer</a>',
		        //'<a href="' . admin_url('admin.php?page=lumen_page') . '">Developer</a>',
	        ));

	    /** Add Shortcodes **/
//	    $wpHelper
//		    ->addShortcode(
//		    'lumen_docs',
//		    \App\Http\Controllers\DocsController::class
//	        );

	    /** Add FrontEnd Widget **/
//	    $wpHelper
//		    ->addWidget(
//		    \App\Widgets\ExampleFrontEndWidget::class
//	        );

	    /** Add Admin Bar Nodes **/
//	    $wpHelper
//		    ->addAdminBarNode(
//			    false,
//			    'lumen_bar_node',
//			    'Lumen Bar Node 1',
//			    '#'
//		    )->addAdminBarNode(
//			    'lumen_bar_node',
//			    'lumen_bar_node_child1',
//			    'Node Child 1',
//			    '#'
//		    )->addAdminBarNode(
//			    'lumen_bar_node',
//			    'lumen_bar_node_child2',
//			    'Node Child 2',
//			    '#'
//		    )->addAdminBarNode(
//			    'lumen_bar_node',
//			    'lumen_bar_node_child3',
//			    'Node Child 2',
//			    '#'
//		    );

	    /** Add Shortcodes for Auth Vue Components **/
	    $wpHelper
		    ->addShortcode(
			    'leadform',
			    \App\Http\Controllers\ShortcodeController::class
		    );

	    /** Add Shortcodes for Auth Vue Components **/
//	    $wpHelper
//		    ->addAdminBarNode(
//		    false,
//		    'lumen_bar_node2',
//		    'Lumen Bar Node',
//		    '#'
//		    )->addAdminBarNode(
//			    'lumen_bar_node2',
//			    'lumen_bar_node2_child1',
//			    'Node Child 1',
//			    '#'
//		    )->addAdminBarNode(
//			    'lumen_bar_node2',
//			    'lumen_bar_node2_child2',
//			    'Node Child 2',
//			    '#'
//		    )->addAdminBarNode(
//			    'lumen_bar_node2',
//			    'lumen_bar_node2_child3',
//			    'Node Child 2',
//			    '#'
//		    );



	    /** Add MetaBoxes **/
//	    $wpHelper
//		    ->addMetaBox(
//		    'example_meta_box',
//		    'Example Meta Box',
//			    function ($post, $metabox_attributes){
//				    return $this->app->call(
//				    	'\App\Http\Controllers\ExampleMetaBoxController@show',
//					    compact('post', 'metabox_attributes')
//				    );
//			    },
//		    'post',
//		    'normal',
//		    'default',
//		    2
//	        )
//		    ->addAction(
//		    	'save_post',
//			    function ($post_id, $post, $update){
//		    		if($post->post_type == 'lumen_docs'){
//					    $this->app->make('cache')->flush();
//				    }
//				    if($post->post_type == 'post') {
//					    return $this->app->call(
//						    '\App\Http\Controllers\ExampleMetaBoxController@save',
//						    compact( 'post_id', 'post', 'update' )
//					    );
//				    }
//			    },
//			    10,
//			    3
//		    );


	    /** Add Nav Menu MetaBoxes **/
//	    $wpHelper->addMetaBox(
//		    'lumen_',
//		    'Wp-Lumen',
//		    function ( $object, $arguments){
//
//			    return $this->app->call(
//				    '\App\Http\Controllers\Controller@makeLoginLogoutNavItems',
//				    compact('object', 'arguments')
//			    );
//		    },
//		    'nav-menus',
//		    'side',
//		    'default',
//		    2
//	    );



	    /** Add Dashboard Widget **/
//	    $wpHelper
//		    ->addDashboardWidget(
//		    'example_admin_widget',
//		    'Example Admin Widget',
//		    \App\Widgets\ExampleAdminWidget::class
//	        );
//

//
//	    /** Add Dashboard Panels **/
//	    $wpHelper
//		    ->addAdminPanel(
//			'lumen_page',
//			'WP-Lumen',
//			'WP-Lumen',
//			\App\Http\Controllers\ExampleAdminController::class,
//			'read'
//	        )
//			->addAdminSubPanel(
//			'lumen_page',
//			'lumen_sub_page',
//			'WP-Lumen SubPage',
//			'WP-Lumen SubPage',
//			\App\Http\Controllers\ExampleAdminController::class,
//			'read'
//			);





	    /** @var \App\Helpers\LumenHelper $lumenHelper **/
	    $lumenHelper = $this->app->make(LumenHelper::class);

	    /** Add CSS & Scripts **/
		//$request = $lumenHelper->request()->capture();


	    $wpHelper
		    ->enqueueScript(
			    'google-maps',
			    'https://maps.googleapis.com/maps/api/js?key='.env('GOOGLE_MAPS_API').'&libraries=places',
			    array(),
			    '1.0.0',
			    true
		    )
		    ->enqueueStyle(
			    'lumen',
			    $lumenHelper->asset('resources/assets/build/A1AutoTransport.css'),
			    array('wpbs-style'),
			    '1.0.1',
			    'all'
		    )
		    ->enqueueScript(
			    'lumen',
			    $lumenHelper->asset('resources/assets/build/A1AutoTransport.js'),
			    array('google-maps','jquery','bower-libs'),
			    '1.0.0',
			    true
		    );




//		// TinyMCE buttons -> Legacy
//	    add_action('init', function() use ($lumenHelper) {
//
//		    //Abort early if the user will never see TinyMCE
//		    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
//			    return;
//
//		    //Add a callback to register our tinymce plugin
//		    add_filter("mce_external_plugins",  function( $plugin_array ) use ($lumenHelper) {
//			    $plugin_array['lead_forms'] = $lumenHelper->asset('resources/assets/forms/a1auto/shortcode.js');
//			    return $plugin_array;
//		    }, 1000);
//
//		    // Add a callback to add our button to the TinyMCE toolbar
//		    add_filter('mce_buttons_3', function( $buttons ) {
//			    array_push( $buttons, 'lead_forms', 'lead_forms_btn');
//			    return $buttons;
//		    });
//	    });



    }
}
