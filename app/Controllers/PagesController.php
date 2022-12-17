<?php

namespace App\Controllers;

use App\SessionGuard as Guard;
use App\Models\HinhThucThanhToan;
use App\Models\NhanHang;
use App\Models\SanPham;
use App\Models\ThuongHieu;
use App\Models\User;
use App\Models\DonHang;
use League\Plates\Engine;
use Illuminate\Database\Capsule\Manager as DBManager;

class PagesController extends Controller
{
	public function __construct()
	{
		$_SESSION['thuonghieu']=ThuongHieu::all();
		parent::__construct();
	}

	public function trang_chu()
	{
		$sanphammuanhieu = Sanpham::inRandomOrder()->take(3)->get();
		$sanphammuanhieu2 = Sanpham::inRandomOrder()->take(3)->get();
		$sanphamdanhgiacao = Sanpham::inRandomOrder()->take(3)->get();
		$sanphamdanhgiacao2 = Sanpham::inRandomOrder()->take(3)->get();
		$sanphamuudai = Sanpham::inRandomOrder()->take(3)->get();
		$sanphamuudai2 = Sanpham::inRandomOrder()->take(3)->get();
		$this->sendPage('pages/trangchu', [
			'thuonghieu' => ThuongHieu::all(),
			'sanphammoi' => SanPham::take(8)->orderBy('id', 'DESC')->get(),
			'sanphammuanhieu' => $sanphammuanhieu,
			'sanphammuanhieu2' => $sanphammuanhieu2,
			'sanphamdanhgiacao' => $sanphamdanhgiacao,
			'sanphamdanhgiacao2' =>$sanphamdanhgiacao2 ,
			'sanphamuudai' => $sanphamuudai,
			'sanphamuudai2' => $sanphamuudai2,

		]);
	}
	public function lien_he()
	{
		$this->sendPage('pages/lienhe', [
			'thuonghieu' => ThuongHieu::all(),
		]);
	}
	public function danh_sach_san_pham()
	{
		$this->sendPage('pages/danhsachsanpham', [
			'thuonghieu' => ThuongHieu::all(),
			'sanpham' => SanPham::select()->orderBy('id', 'DESC')->get()
		]);
	}
	public function tim_kiem()
	{
		$data = $_POST;
		$tukhoa = $data['tukhoa'];
		$sanpham = Sanpham::where('sp_ten', 'like', "%$tukhoa%")->get();
		$this->sendPage('pages/timkiem', [
			'tukhoa' => $tukhoa,
			'thuonghieu' => ThuongHieu::all(),
			'sanpham' => $sanpham
		]);
	}
	public function thuong_hieu($id)
	{
		$sanpham = Sanpham::where('th_id', '=', $id)->get();
		$thuonghieu_name = Thuonghieu::where('id', '=', $id)->first();
		$this->sendPage('pages/thuonghieu', [
			'sanpham' => $sanpham,
			'thuonghieu' => ThuongHieu::all(),
			'thuonghieu_name' => $thuonghieu_name
		]);
	}
	public function chi_tiet_san_pham($id)
	{
		$sanpham = Sanpham::find($id);
		$sanphammuanhieu = Sanpham::inRandomOrder()->take(3)->get();
		$sanphammuanhieu2 = Sanpham::inRandomOrder()->take(3)->get();
		$sanphamdanhgiacao = Sanpham::inRandomOrder()->take(3)->get();
		$sanphamdanhgiacao2 = Sanpham::inRandomOrder()->take(3)->get();
		$sanphamuudai = Sanpham::inRandomOrder()->take(3)->get();
		$sanphamuudai2 = Sanpham::inRandomOrder()->take(3)->get();
		$this->sendPage('pages/chitietsanpham', [
			'sanpham' => $sanpham,
			'thuonghieu' => ThuongHieu::all(),
			'sanphammuanhieu' => $sanphammuanhieu,
			'sanphammuanhieu2' => $sanphammuanhieu2,
			'sanphamdanhgiacao' => $sanphamdanhgiacao,
			'sanphamdanhgiacao2' =>$sanphamdanhgiacao2 ,
			'sanphamuudai' => $sanphamuudai,
			'sanphamuudai2' => $sanphamuudai2,
		]);
	}
	// Giỏ hàng
	public function gio_hang()
	{
		$hinhthucthanhtoan = Hinhthucthanhtoan::all();
		if (isset($_SESSION['kh_id'])) {
			$id = $_SESSION['kh_id'];
			$user = User::find($id);
			$this->sendPage('pages/giohang', [
				'thuonghieu' => ThuongHieu::all(),
				'user' => $user,
				'hinhthucthanhtoan' => $hinhthucthanhtoan,
				'errors' => session_get_once('errors')
			]);
		} else {
			$this->sendPage('pages/giohang', [
				'thuonghieu' => ThuongHieu::all(),
				'hinhthucthanhtoan' => $hinhthucthanhtoan,
				'errors' => session_get_once('errors')
			]);
		}
	}
	public function postThemsanpham()
	{
		$data = $_POST;
		$sp_ma = $data['sp_ma'];
		$sp = SanPham::find($sp_ma);
		$error['loisoluong'] = false;
		if (isset($_SESSION['giohangdata'])) {
			$cart = $_SESSION['giohangdata'];
			if (isset($cart[$sp_ma])) {
				 // Kiểm tra số lượng
				 if ($sp->sp_soluong < $data['soluong'] + $cart[$sp_ma]['soluong']) {
					$error['loisoluong'] = true;
					echo json_encode($error); exit();
				  }
				  // Kết thúc
				$cart[$sp_ma] = array(
					'sp_ma' => $data['sp_ma'],
					'sp_ten' => $data['sp_ten'],
					'soluong' => ($data['soluong'] + $cart[$sp_ma]['soluong']),
					'gia' => $data['sp_gia'],
					'thanhtien' => ($data['soluong'] * $data['sp_gia'] + $cart[$sp_ma]['thanhtien']),
					'hinhdaidien' => $data['hinhdaidien']
				);
			} else {
				 // Kiểm tra số lượng
				 if ($sp->sp_soluong < $data['soluong']) {
					$error['loisoluong'] = true;
					echo json_encode($error);
					exit();
				  }
				  // Kết thúc
				$cart[$sp_ma] = array(
					'sp_ma' => $data['sp_ma'],
					'sp_ten' => $data['sp_ten'],
					'soluong' => ($data['soluong']),
					'gia' => $data['sp_gia'],
					'thanhtien' => ($data['soluong'] * $data['sp_gia']),
					'hinhdaidien' => $data['hinhdaidien']
				);
			}
			$_SESSION['giohangdata'] = $cart;
		} else {
			 // Kiểm tra số lượng
			 if ($sp->sp_soluong < $data['soluong']) {
				$error['loisoluong'] = true;
				echo json_encode($error);
				exit();
			  }
			  // Kết thúc
			$cart[$sp_ma] = array(
				'sp_ma' => $data['sp_ma'],
				'sp_ten' => $data['sp_ten'],
				'soluong' => $data['soluong'],
				'gia' => $data['sp_gia'],
				'thanhtien' => ($data['soluong'] * $data['sp_gia']),
				'hinhdaidien' => $data['hinhdaidien']
			);

			$_SESSION['giohangdata'] = $cart;
		}
		echo json_encode($_SESSION['giohangdata']);
	}
	public function postXoasanpham()
	{
		$sp_ma = $_POST['sp_ma'];
		if (isset($_SESSION['giohangdata'])) {
			$data = $_SESSION['giohangdata'];
			if (isset($data[$sp_ma])) {
				unset($data[$sp_ma]);
			}
			$_SESSION['giohangdata'] = $data;
			echo json_encode($_SESSION['giohangdata']);
		}
	}
	public function postXoatatcasanpham()
	{

		unset($_SESSION['giohangdata']);
		echo json_encode($_SESSION['giohangdata']);
	}

	public function postCapnhatsanpham()
	{
		$sp_ma = $_POST['sp_ma'];
		$soluong = $_POST['soluong'];
		$sp = SanPham::find($sp_ma);
		$error['loisoluong'] = false;
		if ($_SESSION['giohangdata'] == true) {
			$data = $_SESSION['giohangdata'];
			$sanphamcu = $data[$sp_ma];
			 // Kiểm tra số lượng
			 if ($sp->sp_soluong < $soluong) {
				$error['loisoluong'] = true;
				$error['sp_ma']=$sp_ma;
				$error['sp_soluong']=$sp->sp_soluong;
				echo json_encode($error);
				exit();
			  }
			  // Kết thúc
			$data[$sp_ma] = array(
				'sp_ma' => $sanphamcu['sp_ma'],
				'sp_ten' => $sanphamcu['sp_ten'],
				'soluong' => $soluong,
				'gia' => $sanphamcu['gia'],
				'thanhtien' => ($soluong * $sanphamcu['gia']),
				'hinhdaidien' => $sanphamcu['hinhdaidien']
			);

			// lưu dữ liệu giỏ hàng vào session
			$_SESSION['giohangdata'] = $data;
		}
		echo json_encode($_SESSION['giohangdata']);
	}
	public function postDatHang()
	{
		$data = $_POST;
		if ($data['dh_notes'] == '') {
			$data['dh_notes'] = 'Không có ghi chú';
		}
		// var_dump($data);die;
		$data = $this->filterNhanHangData($data);
		
		$model_errors = NhanHang::validate($data);
		// var_dump($model_errors);die;
		// var_dump($data);die;
		if (empty($model_errors)) {
			$nhanhang = new NhanHang();
			$nhanhang->nh_name = $data['nh_name'];
			$nhanhang->nh_email = $data['nh_email'];
			$nhanhang->nh_phone = $data['nh_phone'];
			$nhanhang->nh_address = $data['nh_address'];
			$check_nh = NhanHang::where('nh_name', '=', $nhanhang->nh_name)
				->where('nh_email', '=', $nhanhang->nh_email)
				->where('nh_phone', '=', $nhanhang->nh_phone)
				->where('nh_address', '=', $nhanhang->nh_address)
				->first();
			if (empty($check_nh)) {
				$nhanhang->save();
				$nh_id = $nhanhang->id;
			} else {
				$nh_id = $check_nh->id;
			}
			$donhang = new DonHang();
			$donhang->user_id = $_SESSION['kh_id'];
			$donhang->ht_id = $data['httt'];
			$donhang->dh_status = 0;
			$donhang->dh_tong = $data['dh_tong'];
			$donhang->dh_notes = $data['dh_notes'];
			$donhang->nh_id = $nh_id;
			$donhang->save();
			$dh_id = $donhang->id;
			$giohang = $_SESSION['giohangdata'];
			foreach ($giohang as $sp) {
				$donhang->sanpham()->attach($sp['sp_ma'], [
					'ct_soluongmua' => $sp['soluong'] ,
					'ct_gia' => $sp['gia']
				]);
				$sanpham = SanPham::find($sp['sp_ma']);
				$sanpham->sp_soluong -= $sp['soluong'];
				$sanpham->save();
			}
			unset($_SESSION['giohangdata']);
			redirect('/thanh-cong');
		}

		redirect('/gio-hang', ['errors' => $model_errors]);
	}
	public function getThanhCong()
	{
		$this->sendPage('pages/thanhcong', [
			'thuonghieu' => ThuongHieu::all(),
		]);
	}
	public function getXemDonHang()
	{
		if(!isset($_SESSION['kh_id'])){
			redirect('/');
		}
		$user_id=$_SESSION['kh_id'];
		$donhang=Donhang::where('user_id', '=', $user_id)->orderBy('donhang.id', 'DESC')->get();
		$this->sendPage('pages/xemdonhang', [
			'donhang'	=> $donhang,
			'thuonghieu' => ThuongHieu::all(),
			
		]);
	}
	public function postChitietdonhangapi()
  {
    $id = $_POST['donhang_id'];
    $data = DBManager::table('donhang')
      ->join('chitietdonhang', 'chitietdonhang.dh_id', '=', 'donhang.id')
      ->join('nhanhang', 'nhanhang.id', '=', 'donhang.nh_id')
      ->join('sanpham', 'sanpham.id', '=', 'chitietdonhang.sp_id')
      ->join('hinhthucthanhtoan', 'hinhthucthanhtoan.id', '=', 'donhang.ht_id')
      ->where('donhang.id', $id)
      ->get();
    echo json_encode($data);
  }
	// Nhận hàng
	protected function filterNhanHangData(array $data)
	{
		return [
			'nh_name' => $data['nh_name'] ?? null,
			'nh_address' => $data['nh_address'] ?? null,
			'nh_phone' =>  preg_replace('/\D+/', '', $data['nh_phone']),
			'nh_email' => filter_var($data['nh_email'], FILTER_VALIDATE_EMAIL),
			'httt'=> $data['httt'] ,
			'dh_notes' => $data['dh_notes'] ?? null,
			'dh_tong' => $data['dh_tong'] ?? null,
		];
	}
	// Khách hàng
	public function getDangKy()
	{
		$this->sendPage('pages/dangky', [
			'thuonghieu' => ThuongHieu::all(),
			'old' => $this->getSavedFormValues(),
			'errors' => session_get_once('errors'),
		]);
	}

	public function postDangKy()
	{
		$this->saveFormValues($_POST, ['password', 'passwordAgain']);
		$data = $this->filterUserData($_POST);
		$model_errors = User::validate($data);
		if (empty($model_errors)) {
			// Dữ liệu hợp lệ...
			$this->createUser($data);
			$_SESSION['msg'] = 'Tạo tài khoản thành công.Vui lòng đăng nhập.';
			redirect('/dang-nhap', ['msg' => $_SESSION['msg']]);
		}
		redirect('/dang-ky', ['errors' => $model_errors]);
	}
	protected function filterUserData(array $data)
	{
		return [
			'name' => $data['name'] ?? null,
			'address' => $data['address'] ?? null,
			'phone' =>  preg_replace('/\D+/', '', $data['phone']),
			'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
			'password' => $data['password'] ?? null,
			'passwordAgain' => $data['passwordAgain'] ?? null
		];
	}
	protected function filterUserDataUpdate(array $data)
	{
		if (isset($data['changePassword'])) {
			return [
				'name' => $data['name'] ?? null,
				'address' => $data['address'] ?? null,
				'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
				'phone' =>  preg_replace('/\D+/', '', $data['phone']),
				'changePassword' => $data['changePassword'] ?? null,
				'password' => $data['password'] ?? null,
				'passwordAgain' => $data['passwordAgain'] ?? null
			];
		} else {
			return [
				'name' => $data['name'] ?? null,
				'address' => $data['address'] ?? null,
				'phone' =>  preg_replace('/\D+/', '', $data['phone']),
				'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
				'changePassword' => $data['changePassword'] ?? null,
			];
		}
	}
	protected function createUser($data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => password_hash($data['password'], PASSWORD_DEFAULT),
			'phone' => $data['phone'],
			'address' => $data['address'],
			'quyen' => 0
		]);
	}
	public function getDangNhap()
	{
		$this->sendPage('pages/dangnhap', [
			'thuonghieu' => ThuongHieu::all(),
			'msg' => session_get_once('msg'),
			'old' => $this->getSavedFormValues(),
			'errors' => session_get_once('errors')
		]);
	}
	public function postDangNhap()
	{
		$user_credentials = $this->filterUserCredentials($_POST);
		$errors = [];
		$user = User::where('email', $user_credentials['email'])->first();
		if (!$user) {
			// Người dùng không tồn tại...
			$errors['email'] = 'Email hoặc mật khẩu không đúng.';
		} else if (password_verify($user_credentials['password'], $user->password)) {
			// Đăng nhập thành công...
			$_SESSION['kh_id'] = $user->id;
			$_SESSION['kh_name'] = $user->name;
			redirect('/');
		} else {
			// Sai mật khẩu...
			$errors['password'] = 'Invalid email or password.';
		}

		// Đăng nhập không thành công: lưu giá trị trong form, trừ password
		$this->saveFormValues($_POST, ['password']);
		redirect('/dang-nhap', ['errors' => $errors]);
	}
	public function dangXuat()
	{
		unset($_SESSION['kh_id']);
		unset($_SESSION['kh_name']);
		redirect('/');
	}

	protected function filterUserCredentials(array $data)
	{
		return [
			'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
			'password' => $data['password'] ?? null
		];
	}
	public function getCapNhatThongTin()
	{
		if (!isset($_SESSION['kh_id'])) {
			redirect('/');
		}
		$khachhang = User::find($_SESSION['kh_id']);
		if (!$khachhang) {
			$this->sendNotFound();
		}
		$form_values = $this->getSavedFormValues();
		$data = [
			'errors' => session_get_once('errors'),
			'thuonghieu' => ThuongHieu::all(),
			'khachhang' => (!empty($form_values)) ?
				array_merge($form_values, ['id' => $khachhang->id]) :
				$khachhang->toArray()

		];
		$this->sendPage('pages/capnhatthongtin', $data);
	}
	public function postCapNhatThongTin()
	{
		$khachhang = User::find($_SESSION['kh_id']);
		$data = $this->filterUserDataUpdate($_POST);
		// var_dump($data);die;
		$model_errors = User::validate_sua($data, $khachhang->id);
		if (empty($model_errors)) {
			if(isset($data['changePassword'])) 
            {$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);}
			$khachhang->fill($data);
			$khachhang->save();
			$_SESSION['kh_name'] = $khachhang->name;
			$_SESSION['msg'] = 'Cập nhật thành công';
			redirect('/cap-nhat-thong-tin', ['msg' => $_SESSION['msg']]);
		}
		$this->saveFormValues($_POST);
		redirect('/cap-nhat-thong-tin', [
			'errors' => $model_errors
		]);
	}
}
