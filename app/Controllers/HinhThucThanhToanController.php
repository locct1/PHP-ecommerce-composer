<?php

namespace App\Controllers;

use App\Models\DonHang;
use App\SessionGuard as Guard;
use App\Models\HinhThucThanhToan;
use Illuminate\Database\Capsule\Manager as DBManager;

class HinhThucThanhToanController extends Controller
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
		$this->sendPage('admin/hinhthucthanhtoan/danhsach', [
			'hinhthucthanhtoan' => HinhThucThanhToan::all()
		]);
	}
	public function showAddPage()
	{
		$this->sendPage('admin/hinhthucthanhtoan/them', [
			'errors' => session_get_once('errors'),
			'old' => $this->getSavedFormValues()
		]);
	}
	public function create()
	{
		$this->saveFormValues($_POST);
		$data = $this->filterContactData($_POST);
		$model_errors = HinhThucThanhToan::validate($data);
		if (empty($model_errors)) {
			$contact = new HinhThucThanhToan();

			$contact->fill($data);

			$contact->save();
			$msg_them = 'Thêm thành công';
			redirect('/admin/hinhthucthanhtoan/them', ['msg_them' => $msg_them]);
		}
		// Lưu các giá trị của form vào $_SESSION['form']
		$this->saveFormValues($_POST);
		// Lưu các thông báo lỗi vào $_SESSION['errors']
		redirect('/admin/hinhthucthanhtoan/them', ['errors' => $model_errors]);
	}
	protected function filterContactData(array $data)
	{
		return [
			'ht_ten' => $data['ht_ten'] ?? null
		];
	}
	public function showEditPage($hinhthucthanhtoan_id)
	{
		$hinhthucthanhtoan = HinhThucThanhToan::find($hinhthucthanhtoan_id);
		if (!$hinhthucthanhtoan) {
			$this->sendNotFound();
		}
		$form_values = $this->getSavedFormValues();
		$data = [
			'errors' => session_get_once('errors'),
			'hinhthucthanhtoan' => $hinhthucthanhtoan

		];
		$this->sendPage('admin/hinhthucthanhtoan/sua', $data);
	}
	public function update($hinhthucthanhtoan_id)
	{
		$hinhthucthanhtoan = HinhThucThanhToan::find($hinhthucthanhtoan_id);
		if (!$hinhthucthanhtoan) {
			$this->sendNotFound();
		}
		$data = $this->filterContactData($_POST);
		$model_errors = HinhThucThanhToan::validate($data);
		if (empty($model_errors)) {

			$hinhthucthanhtoan->fill($data);
			$hinhthucthanhtoan->save();
			$msg_sua = 'Sửa thành công';
			redirect('/admin/hinhthucthanhtoan/sua/' . $hinhthucthanhtoan_id, ['msg_sua' => $msg_sua]);
		}

		$this->saveFormValues($_POST);
		redirect('/admin/hinhthucthanhtoan/sua/' . $hinhthucthanhtoan_id, [
			'errors' => $model_errors
		]);
	}
	public function delete($hinhthucthanhtoan_id)
	{
		$hinhthucthanhtoan = HinhThucThanhToan::find($hinhthucthanhtoan_id);

		if (!$hinhthucthanhtoan) {
			$this->sendNotFound();
		}
		$check = DonHang::select()->where('ht_id', $hinhthucthanhtoan_id)->get()->count();
		if ($check > 0) {
			$msg_xoa_loi = "Xóa không thành công, hình thức thanh toán có trong đơn hàng.";
			redirect('/admin/hinhthucthanhtoan/danhsach', [
				'msg_xoa_loi' => $msg_xoa_loi
			]);
		} else {
			$hinhthucthanhtoan->delete();
			$msg_xoa = "Xóa thành công";
			redirect('/admin/hinhthucthanhtoan/danhsach', [
				'msg_xoa' => $msg_xoa
			]);
		}
	}
}
