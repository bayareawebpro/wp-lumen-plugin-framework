<?php namespace App\Http\Controllers;
use App\Helpers\LumenHelper;
use App\Models\WpPost;
use App\Models\WpUser;

class ExampleAdminController extends Controller
{

	private $post, $request, $auth, $helper;

    /**
     * Create a new controller instance.
     * @param $helper LumenHelper
     * @param $post WpPost
     */
    public function __construct(LumenHelper $helper, WpPost $post)
    {
	    $this->post = $post;
	    $this->helper = $helper;
	    $this->request = $this->helper->request();
	    $this->auth = $this->helper->auth();
    }


    public function template(){
	    if($this->request->user()->can('update-user', (object) array('ID'=>1))) {
		    // The user is allowed to update the user object...
		    //echo 'You Can Update User ID 1';
            //echo ('<p>Hello '.$this->auth->user()->display_name .'</p>');
	    }

	    //Verify WP Nonce instead of CSRF
	    if (wp_verify_nonce($this->request->get('lumen_nonce'), 'update') ) {
		    //echo( 'Nonce Verified' );
	    }

	    //Get Paginated Data from Database
	    $this->post = $this->post
		    ->orderBy('post_title', $this->request->get('lumen_nonce'))
		    ->paginate($items = 1, $columns = ['*'], $pageName = 'users_page', $this->request->get('users_page'))
		    ->setPath($this->request->url());


	    //Append Current Admin Page Slug
	    if($this->request->has('page')){
		    $this->post->appends(array(
			    'page'=> $this->request->get('page')
		    ));
	    }

	    return $this->helper->view('admin-page-posts', array(
		    'posts'=>$this->post,
		    'request'=>$this->request,
	    ));
    }
}