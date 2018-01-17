<?php namespace App\Http\Controllers\Auth;

use App\Helpers\LumenHelper;
use App\Http\Controllers\Controller;
use App\Models\WpUser;

class LoginShortcodeController extends Controller
{
	protected $helper, $request, $auth, $user, $validator;

    /**
     * Create a new controller instance.
     * @var $helper LumenHelper
     * @var $user WpUser
     * $user
     */
    public function __construct(LumenHelper $helper)
    {
	    $this->helper = $helper;
	    $this->request = $this->helper->request();
    }

    public function template(){
	    return $this->helper->view('auth.login', array('user' =>$this->request->user()));
    }
}
