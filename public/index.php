<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/../bootstrap.php';

define('APPNAME', 'LKshop');

session_start();

$router = new \Bramus\Router\Router();

// Auth routes
$router->post('/logout', '\App\Controllers\Auth\LoginController@logout');
$router->get('/register', '\App\Controllers\Auth\RegisterController@showRegisterForm');
$router->post('/register', '\\App\Controllers\Auth\RegisterController@register');
$router->get('/login', '\App\Controllers\Auth\LoginController@showLoginForm');
$router->post('/login', '\App\Controllers\Auth\LoginController@login');


// DashBoard
$router->get('/admin/dashboard', '\App\Controllers\DashBoardController@index');
$router->get('/admin/baocao-thongkethuonghieu', '\App\Controllers\DashBoardController@getBaoCaoThongKeThuongHieu');

// Thương hiệu
$router->get('/admin/thuonghieu/danhsach', '\App\Controllers\ThuongHieuController@index');
$router->get('/admin/thuonghieu/them','\App\Controllers\ThuongHieuController@showAddPage');
$router->post('/admin/thuonghieu/them', '\App\Controllers\ThuongHieuController@create');

$router->get('/admin/thuonghieu/sua/(\d+)','\App\Controllers\ThuongHieuController@showEditPage');
$router->post('/admin/thuonghieu/sua/(\d+)','\App\Controllers\ThuongHieuController@update');

$router->get('/admin/thuonghieu/xoa/(\d+)','\App\Controllers\ThuongHieuController@delete');
// Sản Phẩm
$router->get('/admin/sanpham/danhsach', '\App\Controllers\SanPhamController@index');
$router->get('/admin/sanpham/them','\App\Controllers\SanPhamController@showAddPage');
$router->post('/admin/sanpham/them', '\App\Controllers\SanPhamController@create');

$router->get('/admin/sanpham/sua/(\d+)','\App\Controllers\SanPhamController@showEditPage');
$router->post('/admin/sanpham/sua/(\d+)','\App\Controllers\SanPhamController@update');

$router->get('/admin/sanpham/xoa/(\d+)','\App\Controllers\SanPhamController@delete');
// Hình thức thanh toán
$router->get('/admin/hinhthucthanhtoan/danhsach', '\App\Controllers\HinhThucThanhToanController@index');
$router->get('/admin/hinhthucthanhtoan/them','\App\Controllers\HinhThucThanhToanController@showAddPage');
$router->post('/admin/hinhthucthanhtoan/them', '\App\Controllers\HinhThucThanhToanController@create');
$router->get('/admin/hinhthucthanhtoan/sua/(\d+)','\App\Controllers\HinhThucThanhToanController@showEditPage');
$router->post('/admin/hinhthucthanhtoan/sua/(\d+)','\App\Controllers\HinhThucThanhToanController@update');
$router->get('/admin/hinhthucthanhtoan/xoa/(\d+)','\App\Controllers\HinhThucThanhToanController@delete');
// DonHang
$router->get('/admin/donhang/danhsach', '\App\Controllers\DonHangController@getDanhSach');
$router->post('/admin/donhang/donhang-danggiaohang', '\App\Controllers\DonHangController@postDangGiaoHang');
$router->post('/admin/donhang/donhang-dagiaohang', '\App\Controllers\DonHangController@postDaGiaoHang');
$router->get('/admin/donhang/chitietdonhang/(\d+)', '\App\Controllers\DonHangController@getChiTietDonHang');
$router->get('/admin/donhang/xoa/(\d+)', '\App\Controllers\DonHangController@getXoa');
$router->get('/admin/donhang/indonhang/(\d+)','\App\Controllers\DonHangController@getInDonHang');
// User
$router->get('/admin/user/danhsach', '\App\Controllers\UserController@index');
$router->get('/admin/user/them','\App\Controllers\UserController@showAddPage');
$router->post('/admin/user/them', '\App\Controllers\UserController@create');
$router->get('/admin/user/sua/(\d+)','\App\Controllers\UserController@showEditPage');
$router->post('/admin/user/sua/(\d+)','\App\Controllers\UserController@update');
$router->get('/admin/user/xoa/(\d+)','\App\Controllers\UserController@delete');

//Front end
// Trang chính
$router->get('/','\App\Controllers\PagesController@trang_chu');
$router->get('/trang-chu','\App\Controllers\PagesController@trang_chu');
$router->get('/lien-he','\App\Controllers\PagesController@lien_he');
$router->get('/danh-sach-san-pham','\App\Controllers\PagesController@danh_sach_san_pham');
$router->post('/tim-kiem','\App\Controllers\PagesController@tim_kiem');
$router->get('/thuong-hieu/(\d+)','\App\Controllers\PagesController@thuong_hieu');
$router->get('/chi-tiet-san-pham/(\d+)','\App\Controllers\PagesController@chi_tiet_san_pham');
$router->post('/dat-hang','\App\Controllers\PagesController@postDatHang');
$router->get('/thanh-cong','\App\Controllers\PagesController@getThanhCong');
// Giỏ hàng
$router->get('/gio-hang','\App\Controllers\PagesController@gio_hang');
$router->post('giohang-themsanpham','\App\Controllers\PagesController@postThemsanpham');
$router->post('giohang-xoasanpham','\App\Controllers\PagesController@postXoasanpham');
$router->post('giohang-capnhatsanpham','\App\Controllers\PagesController@postCapnhatsanpham');
$router->post('giohang-xoatatca','\App\Controllers\PagesController@postXoatatcasanpham');
$router->get('/xem-don-hang','\App\Controllers\PagesController@getXemDonHang');
$router->post('/chi-tiet-don-hang-api','\App\Controllers\PagesController@postChiTietDonHangApi');
// Đăng nhập, đăng ký, cập nhật thông tin khách hàng
$router->get('/dang-nhap','\App\Controllers\PagesController@getDangNhap');
$router->post('/dang-nhap','\App\Controllers\PagesController@postDangNhap');
$router->get('/dang-ky','\App\Controllers\PagesController@getDangky');
$router->post('/dang-ky','\App\Controllers\PagesController@postDangKy');
$router->get('/dang-xuat','\App\Controllers\PagesController@dangXuat');
$router->get('/cap-nhat-thong-tin','\App\Controllers\PagesController@getCapNhatThongTin');
$router->post('/cap-nhat-thong-tin','\App\Controllers\PagesController@postCapNhatThongTin');

$router->set404('\App\Controllers\Controller@sendNotFound');
$router->run();
