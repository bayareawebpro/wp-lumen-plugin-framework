<?php namespace App\Http\Controllers\Auth;

use App\Helpers\LumenHelper;
use App\Http\Controllers\Controller;
use App\Models\WpUser;

class RegisterShortcodeController extends Controller
{
	protected $helper, $request, $auth, $user, $validator;

    /**
     * Create a new controller instance.
     * @var $helper LumenHelper
     * @var $user WpUser
     * $user
     */
    public function __construct(LumenHelper $helper, WpUser $user)
    {
	    $this->user = $user;
	    $this->helper = $helper;
	    $this->request = $this->helper->request();
    }

	public function template(){
		return $this->helper->view('auth.register', array('user' =>$this->request->user()));
	}

}
