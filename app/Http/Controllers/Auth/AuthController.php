<?php namespace App\Http\Controllers\Auth;

use App\Helpers\LumenHelper;
use App\Http\Controllers\Controller;
use App\Models\WpUser;

class AuthController extends Controller
{
	protected $helper, $request, $auth, $user, $validator;

    /**
     * Create a new controller instance.
     * @var $helper LumenHelper
     * @var $user WpUser
     */
    public function __construct(LumenHelper $helper, WpUser $user)
    {
	    $this->user = $user;
	    $this->helper = $helper;
	    $this->request = $this->helper->request();
	    $this->auth = $this->helper->auth();
	    $this->validator = $this->helper->validator();
    }

    public function register(){

	    $rules = [
		    'display_name' => 'bail|required|min:3',
		    'user_email' => 'bail|required|email|unique:users',
		    'user_pass'   => 'bail|required|min:8|confirmed',
		    'user_pass_confirmation'   => 'bail|required|min:8',
	    ];
	    $messages = [
		    'display_name.required' => 'Display Name is required.',
		    'display_name.min' => 'Display Name must be at least 3 characters in length.',
		    'user_email.email' => 'Email must be a valid email address format.',
		    'user_email.required' => 'Email address is required.',
		    'user_email.unique'   => 'Email address must be unique for each account.',
		    'user_pass.required'   => 'Passwords are required.',
		    'user_pass.min'   => 'Passwords must be at least 8 characters in length.',
		    'user_pass.confirmed'   => 'Passwords must match.',
		    'user_pass_confirmation.required'   => 'Password confirmation is required.',
		    'user_pass_confirmation.min'   => 'Passwords must be at least 8 characters in length.',
	    ];


	    $this->validate($this->request, $rules, $messages);

	    $user = new WpUser;
	    $user->fill($this->request->all());
	    $user->save();
	    $user->wpLogin();

	    return $this->helper->response(array(), 200);

    }

	public function login(){

		$this->getValidationFactory()->extendImplicit('wp_password', function ($attribute, $value, $parameters, $validator) {
			if($this->user->where('user_email',$this->request->get('user_email'))->exists()){
				$user = $this->user->where('user_email',$this->request->get('user_email'))->first();
				return wp_check_password($value, $user->user_pass, $user->ID);
			}
			return false;
		});

		$rules = [
			'user_email' => 'bail|required|email|exists:users',
			'user_pass'   => 'bail|required|min:8|wp_password',
		];
		$messages   = [
			'user_email.required' => 'Email address is required.',
			'user_email.email' => 'Email must be a valid email address format.',
			'user_email.exists'   => 'Credentials do not match our records, try again.',
			'user_pass.required'   => 'Password is required.',
			'user_pass.min'   => 'Password must be at least 8 characters in length.',
			'user_pass.wp_password' => 'Credentials do not match our records, try again.',
		];

		$this->validate($this->request, $rules, $messages);

		$user = $this->user->where('user_email',$this->request->get('user_email'))->first();
		$user->wpLogin();

		return $this->helper->response(array(), 200);
	}

	public function sendResetEmail(){


	}

	public function resetPassword(){


	}

	public function logout(){

		wp_logout();
		return $this->helper->redirect('/');
	}

}
