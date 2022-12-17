<?php

namespace App\Controllers;

use App\SessionGuard as Guard;
use App\Models\SanPham;
use App\Models\DonHang;
use App\Models\User;
use App\Models\HinhThucThanhToan;
use App\Models\ThuongHieu;
use Illuminate\Database\Capsule\Manager as DBManager;

class DashBoardController extends Controller
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
		$users = User::all()->count();
		$donhangxuly = DonHang::where('dh_status', '=', '2')->count();
		$tongdonhang = DonHang::all()->count();
		$sanpham = SanPham::all()->count();
		$doanhthu = DonHang::where('dh_status', '=', '2')->sum('dh_tong');
		$this->sendPage('admin/dashboard', [
			'users' => $users,
			'donhangxuly' => $donhangxuly,
			'tongdonhang' => $tongdonhang,
			'sanpham' => $sanpham,
			'doanhthu' => $doanhthu,
		]);
	}
	public function getBaoCaoThongKeThuongHieu()
	{
			$thuonghieu = ThuongHieu::withCount('sanpham')->get();
		foreach ($thuonghieu as $th) {
			$data[] = array(
				'TenThuongHieu' => $th->th_ten,
				'SoLuong' => $th->sanpham_count
			);
		}
		echo json_encode($data);
	}
}
