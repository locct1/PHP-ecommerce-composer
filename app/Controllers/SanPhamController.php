<?php

namespace App\Controllers;

use App\SessionGuard as Guard;
use App\Models\SanPham;
use App\Models\ThuongHieu;
use Illuminate\Database\Capsule\Manager as DBManager;
class SanPhamController extends Controller
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
        $this->sendPage('admin/sanpham/danhsach', [
            'sanpham' => SanPham::all()
        ]);
    }
    public function showAddPage()
    {
        $this->sendPage('admin/sanpham/them', [
            'errors' => session_get_once('errors'),
            'old' => $this->getSavedFormValues(),
            'thuonghieu' => ThuongHieu::all()
        ]);
    }
    public function create()
    {
        $data = $this->filterData($_POST);
        $model_errors = SanPham::validate($data);
        if (empty($model_errors)) {
            $sanpham = new SanPham();
            $hinhanh_tmp = $_FILES['sp_hinhanh']['tmp_name'];
            $data['sp_hinhanh'] = time() . '_' . $data['sp_hinhanh'];
            $data['sp_gia'] = filter_var($data['sp_gia'], FILTER_SANITIZE_NUMBER_INT);

            $sanpham->fill($data);

            move_uploaded_file($hinhanh_tmp, 'upload/sanpham/' . $data['sp_hinhanh']);
            $sanpham->save();
            $msg_them = 'Thêm thành công';
            redirect('/admin/sanpham/them', ['msg_them' => $msg_them]);
        }
        // Lưu các giá trị của form vào $_SESSION['form']
        $this->saveFormValues($_POST);
        // Lưu các thông báo lỗi vào $_SESSION['errors']
        redirect('/admin/sanpham/them', ['errors' => $model_errors]);
    }
    protected function filterData(array $data)
    {
        $data['sp_hinhanh'] = $_FILES['sp_hinhanh']['name'];
        if ($data['sp_hinhanh'] != '') {
            return [
                'sp_ten' => $data['sp_ten'] ?? null,
                'sp_soluong' => $data['sp_soluong'] ?? null,
                'sp_gia' => filter_var($data['sp_gia'], FILTER_SANITIZE_NUMBER_INT) ?? null,
                'sp_giacu' => filter_var($data['sp_giacu'], FILTER_SANITIZE_NUMBER_INT) ?? 0,
                'sp_km' => $data['sp_km'] ?? null,
                'sp_tskt' => $data['sp_tskt'] ?? null,
                'sp_mtct' => $data['sp_mtct'] ?? null,
                'th_id' => $data['th_id'] ?? null,
                'sp_hinhanh' => $data['sp_hinhanh'] ?? null
            ];
        } else {
            return [
                'sp_ten' => $data['sp_ten'] ?? null,
                'sp_soluong' => $data['sp_soluong'] ?? null,
                'sp_gia' => filter_var($data['sp_gia'], FILTER_SANITIZE_NUMBER_INT) ?? null,
                'sp_giacu' => filter_var($data['sp_giacu'], FILTER_SANITIZE_NUMBER_INT) ?? 0,
                'sp_km' => $data['sp_km'] ?? null,
                'sp_tskt' => $data['sp_tskt'] ?? null,
                'sp_mtct' => $data['sp_mtct'] ?? null,
                'th_id' => $data['th_id'] ?? null,
            ];
        }
    }
    public function showEditPage($sanpham_id)
    {
        $sanpham = SanPham::find($sanpham_id);
        if (!$sanpham) {
            $this->sendNotFound();
        }
        $old=$this->getSavedFormValues();
        $data = [
            'errors' => session_get_once('errors'),
            'sanpham' => $sanpham,
            'old' => $old,
            'thuonghieu' => ThuongHieu::all()

        ];
        $this->sendPage('admin/sanpham/sua', $data);
    }
    public function update($sanpham_id)
    {
        $sanpham = SanPham::find($sanpham_id);
        if (!$sanpham) {
            $this->sendNotFound();
        }
      
        $data = $this->filterData($_POST);
        $model_errors = SanPham::validate_sua($data);
       
        if (empty($model_errors)) {
            // $data['sp_gia'] = filter_var($data['sp_gia'], FILTER_SANITIZE_NUMBER_INT);
            // $data['sp_giacu'] = filter_var($data['sp_giacu'], FILTER_SANITIZE_NUMBER_INT);
            if ($data['sp_hinhanh'] != '') {
                unlink('upload/sanpham/' . $sanpham['sp_hinhanh']);
                $hinhanh_tmp = $_FILES['sp_hinhanh']['tmp_name'];
                $data['sp_hinhanh'] = time() . '_' . $data['sp_hinhanh'];
                move_uploaded_file($hinhanh_tmp, 'upload/sanpham/' . $data['sp_hinhanh']);
                $sanpham->fill($data);
                $sanpham->save();
                $msg_sua = 'Sửa thành công';
                redirect('/admin/sanpham/sua/' . $sanpham_id, ['msg_sua' => $msg_sua]);
            } else {
                $sanpham->fill($data);
                $sanpham->save();
                $msg_sua = 'Sửa thành công';
                redirect('/admin/sanpham/sua/' . $sanpham_id, ['msg_sua' => $msg_sua]);
            }
        }

        $this->saveFormValues($_POST);
        redirect('/admin/sanpham/sua/' . $sanpham_id, [
            'errors' => $model_errors
        ]);
    }
    public function delete($sanpham_id)
    {
        $sanpham = SanPham::find($sanpham_id);

        if (!$sanpham) {
            $this->sendNotFound();
        }
        
        $check=DBManager::table('chitietdonhang')->where('sp_id',$sanpham_id)->get()->count();
      if($check>0){
        $msg_xoa_loi = "Xóa không thành công, sản phẩm có trong chi tiết đơn hàng.";
        redirect('/admin/sanpham/danhsach', [
            'msg_xoa_loi' => $msg_xoa_loi
        ]);
      }
      else{
        $sanpham->delete();
        unlink('upload/sanpham/' . $sanpham['sp_hinhanh']);
        $msg_xoa = "Xóa thành công";
        redirect('/admin/sanpham/danhsach', [
            'msg_xoa' => $msg_xoa
        ]);
      }
        
    }
}
