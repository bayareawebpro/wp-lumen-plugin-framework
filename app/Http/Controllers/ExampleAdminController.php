<?php namespace App\Http\Controllers;
use App\Helpers\LumenHelper;
use App\Models\WpPost;
use App\Models\WpUser;

class ExampleAdminController extends Controller
{

	private $users, $request, $auth, $helper;

    /**
     * Create a new controller instance.
     * @param array $panel_attributes (injected automatically)
     */
    public function __construct(LumenHelper $helper, WpPost $user, $panel_attributes)
    {
	    $this->users = $user;

	    $this->helper = $helper;
	    $this->request = $this->helper->request();
	    $this->auth = $this->helper->auth();

	    $this->data();
	    $this->template();
    }

    public function data(){

	    if ($this->request->user()->can('update-user', (object) array('ID'=>1))) {
		    // The user is allowed to update the post...
		    echo 'You Can Update User ID 1';
	    }

    	echo ('<p>Hello '.$this->auth->user()->display_name .'</p>');

	    //Verify WP Nonce instead of CSRF
	    if (wp_verify_nonce($this->request->get('lumen_nonce'), 'update') ) {
		    echo( 'Nonce Verified' );
	    }

	    //Get Paginated Data from Database
	    $this->users = $this->users->paginate($items = 10, $columns = ['*'], $pageName = 'users_page', $this->request->get('users_page'))->setPath($this->request->url());


	    //Append Current Admin Page Slug
	    if($this->request->has('page')){
		    $this->users->appends(array(
			    'page'=> $this->request->get('page')
		    ));
	    }
    }

    public function template(){

	    echo $this->helper->view('admin-page', array(
		    'users'=>$this->users,
		    'request'=>$this->request,
	    ))->render();

    }
}