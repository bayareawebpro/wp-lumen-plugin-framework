<?php namespace App\Http\Controllers;
use App\Helpers\LumenHelper;
use App\Models\WpPost;
use App\Models\WpUser;

class SettingsController extends Controller
{
	protected $post, $request, $auth, $helper, $settings;

    /**
     * Create a new controller instance.
     * @param $helper LumenHelper
     * @param $post WpPost
     * @throws \Exception
     */
    public function __construct(LumenHelper $helper, WpPost $post)
    {
	    $this->post = $post;
	    $this->helper = $helper;
	    $this->request = $this->helper->request();
	    $this->auth = $this->helper->auth();
	    $this->settings = $this->helper->make('settings');
        if($this->request->filled('action')){
            $this->data();
        }
    }

    /**
     * Process the Request Data
     * @throws \Exception
     */
    private function data(){

        $this->helper->validateCSRF();

            switch($this->request->get('action')){
                case 'forget':
                    $this->settings->forget($this->request->get('key'));
                    break;
                case 'add':
                    $this->settings->set($this->request->only(['key', 'value']));
                    break;
                case 'update':
                    $this->settings->set($this->request->only(['key', 'value']), true);
                    break;
            }
            $this->settings->save();
    }

    /**
     * Show the view
     * @throws \Exception
     */
    public function template(){
	    return $this->helper->view('admin-settings', array(
	        'settings' => $this->settings
        ));
    }
}