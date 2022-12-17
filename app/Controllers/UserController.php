<?php

namespace App\Controllers;

use App\SessionGuard as Guard;
use App\Models\User;
use App\Models\DonHang;

class UserController extends Controller
{
	public function __construct()
	{
		if (!Guard::isUserLoggedIn()) {
			redirect('/login');
		}

		parent::__construct();
	}

	public function index()
	{
		$this->sendPage('admin/user/danhsach', [
			'user' => User::all()
		]);
	}
	public function showAddPage()
	{
		$this->sendPage('admin/user/them', [
			'errors' => session_get_once('errors'),
			'old' => $this->getSavedFormValues()
		]);
	}
	public function create()
	{
        $this->saveFormValues($_POST, ['password', 'passwordAgain']);
		$data = $this->filterData($_POST);

		$model_errors = User::validate($data);
		if (empty($model_errors)) {
            $this->createUser($data);
			$msg_them = 'Thêm thành công';
			redirect('/admin/user/them', ['msg_them' => $msg_them]);
		}
		// Lưu các giá trị của form vào $_SESSION['form']
		$this->saveFormValues($_POST);
		// Lưu các thông báo lỗi vào $_SESSION['errors']
		redirect('/admin/user/them', ['errors' => $model_errors]);
	}
    protected function createUser($data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => password_hash($data['password'], PASSWORD_DEFAULT),
			'phone' => $data['phone'],
			'address' => $data['address'],
			'quyen' => $data['quyen']
		]);
	}
	protected function filterData(array $data)
	{
		return [
			'name' => $data['name'] ?? null,
			'address' => $data['address'] ?? null,
			'phone' =>  preg_replace('/\D+/', '', $data['phone']),
			'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
            'quyen' => $data['quyen'] ?? null,
			'password' => $data['password'] ?? null,
			'passwordAgain' => $data['passwordAgain'] ?? null
		];
	
	}
	public function showEditPage($user_id)
	{
        $user = User::find($user_id);
		$form_values = $this->getSavedFormValues($_POST,['password', 'passwordAgain']);
		$data = [
			'errors' => session_get_once('errors'),
			'user' => (!empty($form_values)) ?
				array_merge($form_values, ['id' => $user->id]) :
				$user->toArray()

		];
		$this->sendPage('/admin/user/sua', $data);
	}
	public function update($user_id)
	{
		$user = User::find($user_id);
		$data = $this->filterUserDataUpdate($_POST);
		// var_dump($data);die;
		$model_errors = User::validate_sua($data, $user->id);
        // var_dump($data);die;
    // var_dump($data);
    // var_dump($model_errors);die;
		if (empty($model_errors)) {
            if(isset($data['changePassword'])) 
            {$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);}
			$user->fill($data);
			$user->save();
			$_SESSION['msg_sua'] = 'Sửa thành công';
			redirect('/admin/user/sua/'.$user_id, ['msg_sua' => $_SESSION['msg_sua']]);
		}
		$this->saveFormValues($_POST);
		redirect('/admin/user/sua/'.$user_id, [
			'errors' => $model_errors
		]);
	}
	public function delete($user_id)
	{
        $user = User::find($user_id);
        $donhang=Donhang::where('user_id',$user_id)->get();
       foreach($donhang as $dh){
        $dh->sanpham()->where('donhang.id', $dh->id)->wherePivot('dh_id', $dh->id)->detach();
        DonHang::where('id',$dh->id)->delete();
    }
        $user->delete();
        $msg_xoa='Xóa thành công';
        redirect('/admin/user/danhsach', [
			'msg_xoa' => $msg_xoa
		]);
	}
    protected function filterUserDataUpdate(array $data)
	{
		if (isset($data['changePassword'])) {
			return [
				'name' => $data['name'] ?? null,
				'address' => $data['address'] ?? null,
				'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
				'phone' =>  preg_replace('/\D+/', '', $data['phone']),
                'quyen' => $data['quyen'] ?? null,
                'changePassword' => $data['changePassword'] ?? null,
				'password' =>$data['password'] ?? null,
				'passwordAgain' => $data['passwordAgain'] ?? null
			];
		} else {
			return [
				'name' => $data['name'] ?? null,
				'address' => $data['address'] ?? null,
				'phone' =>  preg_replace('/\D+/', '', $data['phone']),
                'quyen' => $data['quyen'] ?? null,
                'changePassword' => $data['changePassword'] ?? null,
				'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
			];
		}
	}
}
