<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	protected $input;
	protected $user_data;

	public function __construct()
	{
		// Fetch the Site Settings object
		$this->input = Input::all();
		$this->user_data = Auth::user();
		View::share(array ('input' => $this->input));
	}

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	protected function getMessage($message, $redirect = false) {
		return View::make('message', array(
			'message'   => $message,
			'redirect'  => $redirect,
		));
	}

}
