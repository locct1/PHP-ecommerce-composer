<?php

namespace App\Controllers;

use App\Models\DonHang;
use App\Models\NhanHang;
use App\SessionGuard as Guard;
use App\Models\SanPham;
use App\Models\ThuongHieu;

class DonHangController extends Controller
{
    public function __construct()
    {
        if (!Guard::isUserLoggedIn()) {
            redirect('/login');
        }
        parent::__construct();

    }

    public function getDanhSach()
    {
        $this->sendPage('admin/donhang/danhsach', [
            'donhang' => DonHang::all(),
        ]);
    }
    public function postDangGiaoHang()
    {
        $donhang = Donhang::find($_POST['dh_id']);
        $donhang->dh_status = 1;
        $donhang->save();
        echo json_encode($donhang);
    }
    public function postDaGiaoHang()
    {
        $donhang = Donhang::find($_POST['dh_id']);
        $donhang->dh_status = 2;
        $donhang->save();
        echo json_encode($donhang);
    }
   
    public function getXoa($id)
    {
        $donhang = Donhang::find($id);
        $donhang->sanpham()->where('donhang.id', $id)->wherePivot('dh_id', $id)->detach();
        $nhanhang = Donhang::select('nh_id')->distinct()->get();
        echo '<pre>' . $nhanhang . '</pre>';
        $donhang->delete();
        NhanHang::select()->whereNotIn('id', Donhang::select('nh_id')->distinct()->get())->delete();
        $msg_xoa = "Xóa thành công";
        redirect('/admin/donhang/danhsach',[
            'msg_xoa' => $msg_xoa
        ]);
    }
    public function getChiTietDonHang($id)
    {
        $this->sendPage('admin/donhang/chitietdonhang', [
            'donhang' => DonHang::find($id),
        ]);
    }
    public function getInDonHang($id)
    {
        $donhang = Donhang::find($id);
        $this->sendPage('admin/donhang/indonhang', [
            'donhang' => DonHang::find($id),
        ]);
    }
}
