<?php namespace App\Http\Controllers;

use App\Helpers\LumenHelper;

class ExampleTranslationController extends Controller
{
	protected $helper, $translator;

	/**
	 * Create a new controller instance.
	 */
	public function __construct(LumenHelper $helper)
	{
		$this->helper = $helper;
		$this->translator = $this->helper->make('translator');
		$this->translator->setLocale('en');
	}

	public function show(){
		echo $this->translator->trans('talk.test');
	}
}
