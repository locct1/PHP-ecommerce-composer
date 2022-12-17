<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use App\SessionGuard as Guard;

class RegisterController extends Controller
{
	public function __construct()
	{
		if (Guard::isUserLoggedIn()) {
			redirect('/home');
		}

		parent::__construct();
	}

	public function showRegisterForm()
	{
		$data = [
			'old' => $this->getSavedFormValues(),
			'errors' => session_get_once('errors')
		];

		$this->sendPage('auth/register', $data);
	}

	public function register()
	{
		$this->saveFormValues($_POST, ['password', 'password_confirmation']);

		$data = $this->filterUserData($_POST);
		$model_errors = User::validate($data);
		if (empty($model_errors)) {
			// Dữ liệu hợp lệ...
			$this->createUser($data);

			$messages = ['success' => 'User has been created successfully.'];
			redirect('/login', ['messages' => $messages]);
		}

		// Dữ liệu không hợp lệ...
		redirect('/register', ['errors' => $model_errors]);
	}

	protected function filterUserData(array $data)
	{
		return [
			'name' => $data['name'] ?? null,
			'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
			'password' => $data['password'] ?? null,
			'password_confirmation' => $data['password_confirmation'] ?? null
		];
	}

	protected function createUser($data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => password_hash($data['password'], PASSWORD_DEFAULT)
		]);
	}
}
