<?php namespace App\Http\Controllers;
use App\Helpers\LumenHelper;
use App\Models\WpPost;

class ExampleMetaBoxController extends Controller
{
	private $helper, $post, $request;
    /**
     * Create a new controller instance.
     * @param array $metabox_attributes (injected automatically)
     */
    public function __construct(LumenHelper $helper, WpPost $post)
    {
	    $this->helper = $helper;
	    $this->request = $this->helper->request();
	    $this->post = $post;
    }


	public function menuMetaBox(){
		return 'Test';
	}

	public function show($post, $metabox_attributes){

		$post = $this->post->find($post->ID);
	    return $this->helper->view('meta_box', compact('post', 'metabox_attributes'));
    }

	public function save($post, $post_id, $update){

		//The user is allowed to update the post...
    	if(
    		$this->request->filled('lumen_new_title')
	       && $this->request->user()->can('update-post', $post)
	    ) {
		    $this->post = $this->post->find($post_id);
		    $this->post->post_title = $this->request->get('lumen_new_title');
		    $this->post->save();

			//$newpost = new WpPost();
			//$newpost->post_title = str_random(16);
			//$newpost->post_name = str_random(16);
			//$newpost->post_author = 1;
			//$newpost->save();
			//$newpost->attachTaxonomy(22);
			//$newpost->detachTaxonomy(22);
	    }
	}


}
