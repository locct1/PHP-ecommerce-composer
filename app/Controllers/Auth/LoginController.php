<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use App\SessionGuard as Guard;

class LoginController extends Controller
{
	public function showLoginForm()
	{
		if (Guard::isUserLoggedIn()) {
			redirect('/admin/dashboard');
		}

		$data = [
			'messages' => session_get_once('messages'),
			'old' => $this->getSavedFormValues(),
			'errors' => session_get_once('errors')
		];

		$this->sendPage('auth/login', $data);
	}

	public function login()
	{
		$user_credentials = $this->filterUserCredentials($_POST);

		$errors = [];
		$user = User::where('email', $user_credentials['email'])->where('quyen', 1)->first();
		if (!$user) {
			// Người dùng không tồn tại...
			$errors['email'] = 'Email hoặc mật khẩu không chính xác';
		} else if (Guard::login($user, $user_credentials)) {
			// Đăng nhập thành công...
			redirect('/admin/dashboard');
		} else {
			// Sai mật khẩu...
			$errors['password'] = 'Email hoặc mật khẩu không chính xác';
		}

		// Đăng nhập không thành công: lưu giá trị trong form, trừ password
		$this->saveFormValues($_POST, ['password']);
		redirect('/login', ['errors' => $errors]);
	}

	public function logout()
	{
		Guard::logout();
		redirect('/login');
	}

	protected function filterUserCredentials(array $data)
	{
		return [
			'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
			'password' => $data['password'] ?? null
		];
	}
}
