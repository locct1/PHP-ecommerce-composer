<?php

namespace App\Controllers;

use App\SessionGuard as Guard;
use App\Models\ThuongHieu;
use App\Models\SanPham;
use Illuminate\Database\Capsule\Manager as DBManager;
class ThuongHieuController extends Controller
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
		$this->sendPage('admin/thuonghieu/danhsach', [
			'thuonghieu' => ThuongHieu::all()
		]);
	}
	public function showAddPage()
	{
		$this->sendPage('admin/thuonghieu/them', [
			'errors' => session_get_once('errors'),
			'old' => $this->getSavedFormValues()
		]);
	}
	public function create()
	{
		$data = $this->filterData($_POST);

		$model_errors = ThuongHieu::validate($data);
		if (empty($model_errors)) {
			$thuonghieu = new ThuongHieu();
			$hinhanh_tmp = $_FILES['th_hinhanh']['tmp_name'];
			$data['th_hinhanh'] = time() . '_' . $data['th_hinhanh'];
			$thuonghieu->fill($data);
			move_uploaded_file($hinhanh_tmp, 'upload/thuonghieu/' . $data['th_hinhanh']);
			$thuonghieu->save();
			$msg_them = 'Thêm thành công';
			redirect('/admin/thuonghieu/them', ['msg_them' => $msg_them]);
		}
		// Lưu các giá trị của form vào $_SESSION['form']
		$this->saveFormValues($_POST);
		// Lưu các thông báo lỗi vào $_SESSION['errors']
		redirect('/admin/thuonghieu/them', ['errors' => $model_errors]);
	}
	protected function filterData(array $data)
	{
		$data['th_hinhanh'] = $_FILES['th_hinhanh']['name'];
		if ($data['th_hinhanh'] != '') {
			return [
				'th_ten' => $data['th_ten'] ?? null,

				'th_hinhanh' => $data['th_hinhanh'] ?? null
			];
		} else {
			return [
				'th_ten' => $data['th_ten'] ?? null,
			];
		}
	}
	public function showEditPage($thuonghieu_id)
	{
		$thuonghieu = ThuongHieu::find($thuonghieu_id);
		if (!$thuonghieu) {
			$this->sendNotFound();
		}
		$data = [
			'errors' => session_get_once('errors'),
			'thuonghieu' => $thuonghieu,
			'old' => $this->getSavedFormValues()
		];
		$this->sendPage('admin/thuonghieu/sua', $data);
	}
	public function update($thuonghieu_id)
	{
		$thuonghieu = ThuongHieu::find($thuonghieu_id);
		if (!$thuonghieu) {
			$this->sendNotFound();
		}
		$data = $this->filterData($_POST);
		$model_errors = ThuongHieu::validate_sua($data);
		if (empty($model_errors)) {
			if ($data['th_hinhanh'] != '') {
				unlink('upload/thuonghieu/' . $thuonghieu['th_hinhanh']);
				$hinhanh_tmp = $_FILES['th_hinhanh']['tmp_name'];
				$data['th_hinhanh'] = time() . '_' . $data['th_hinhanh'];
				move_uploaded_file($hinhanh_tmp, 'upload/thuonghieu/' . $data['th_hinhanh']);
				$thuonghieu->fill($data);
				$thuonghieu->save();
				$msg_sua = 'Sửa thành công';
				redirect('/admin/thuonghieu/sua/' . $thuonghieu_id, ['msg_sua' => $msg_sua]);
			} else {
				$thuonghieu->fill($data);
				$thuonghieu->save();
				$msg_sua = 'Sửa thành công';
				redirect('/admin/thuonghieu/sua/' . $thuonghieu_id, ['msg_sua' => $msg_sua]);
			}
		}
		$this->saveFormValues($_POST);
		redirect('/admin/thuonghieu/sua/' . $thuonghieu_id, [
			'errors' => $model_errors
		]);
	}
	public function delete($thuonghieu_id)
	{
		$thuonghieu = ThuongHieu::find($thuonghieu_id);
		if (!$thuonghieu) {
			$this->sendNotFound();
		}
		$check = SanPham::select()->where('th_id', $thuonghieu_id)->get()->count();
		if($check>0){
			$msg_xoa_loi = "Xóa không thành công, thương hiệu có tồn tại sản phẩm.";
			redirect('/admin/thuonghieu/danhsach', [
				'msg_xoa_loi' => $msg_xoa_loi
			]);
		}else{
			$thuonghieu->delete();
			unlink('upload/thuonghieu/' . $thuonghieu['th_hinhanh']);
			$msg_xoa = "Xóa thành công";
			redirect('/admin/thuonghieu/danhsach', [
				'msg_xoa' => $msg_xoa
			]);
		}
	}
}
