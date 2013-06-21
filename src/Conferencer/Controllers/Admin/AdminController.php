<?php
namespace Conferencer\Controllers\Admin;

use Auth;
use BaseController;
use Input;
use Redirect;
use View;

class AdminController extends BaseController
{

	/**
	 * Puts authentification filter on protected routes
	 */
	public function __construct()
	{
		$this->beforeFilter('auth', array(
			'only' => array('getIndex'),
		));
	}

	/**
	 * Display the administration's home
	 *
	 * @return View
	 */
	public function getIndex()
	{
		return View::make('conferencer::admin.index');
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////// AUTHENTIFICATION ///////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Display the login form
	 *
	 * @return  View
	 */
	public function getLogin()
	{
		return View::make('conferencer::admin.login');
	}

	/**
	 * Authentificate User
	 *
	 * @return Redirect
	 */
	public function postLogin()
	{
		$input = Input::only(array('username', 'password'));

		// If attempt is successful, redirect
		if (Auth::attempt($input)) {
			return Redirect::action('Conferencer\Controllers\Admin\AdminController@getIndex');
		}

		return Redirect::action('Conferencer\Controllers\Admin\AdminController@getLogin')
			->with('error', true)
			->withInput();
	}

	/**
	 * Log out of the administration
	 *
	 * @return Redirect
	 */
	public function getLogout()
	{
		Auth::logout();

		return Redirect::to('/');
	}

}
