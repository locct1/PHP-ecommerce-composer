<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'sanpham';
    protected $fillable = ['sp_ten', 'th_id','sp_soluong','sp_gia','sp_giacu','sp_hinhanh','sp_km','sp_tskt','sp_mtct'];
    public function thuonghieu()
    {
        return $this->belongsTo(ThuongHieu::class,'th_id','id');
    }
    public function donhang()
	{
		return $this->belongsToMany(DonHang::class, 'chitietdonhang','sp_id','dh_id')->withPivot('id','ct_soluongmua','ct_gia')->withTimestamps();
	}
    public static function validate(array $data)
    {
        $errors = [];
        if ($data['sp_ten']=='') {
            $errors['sp_ten'] = 'Vui lòng nhập tên sản phẩm';
        }
        if ($data['sp_soluong']=='') {
            $errors['sp_soluong'] = 'Vui lòng nhập số lượng';
        }
        if ($data['sp_gia']=='') {
            $errors['sp_gia'] = 'Vui lòng nhập giá';
        }
        if ($data['sp_km']=='') {
            $errors['sp_km'] = 'Vui lòng nhập khuyến mãi';
        }
        if ($data['th_id']=='') {
            $errors['th_id'] = 'Vui lòng chọn thương hiệu';
        }
        if ($data['sp_tskt']=='') {
            $errors['sp_tskt'] = 'Vui lòng nhập thông số kỹ thuật';
        }
        if ($data['sp_mtct']=='') {
            $errors['sp_mtct'] = 'Vui lòng mô tả chi tiết';
        }
        if ($data['sp_hinhanh']=='') {
            $errors['sp_hinhanh'] = 'Vui lòng nhập hình ảnh';
        }
        return $errors;
    }
    public static function validate_sua(array $data)
    {
        $errors = [];

        if ($data['sp_ten']=='') {
            $errors['sp_ten'] = 'Vui lòng nhập tên sản phẩm';
        }
        if ($data['sp_soluong']=='') {
            $errors['sp_soluong'] = 'Vui lòng nhập số lượng';
        }
        if ($data['sp_gia']=='') {
            $errors['sp_gia'] = 'Vui lòng nhập giá hiện tại';
        }
        //var_dump((!$data['sp_giacu'])) ;die;
        if ($data['sp_giacu']=='' && $data['sp_giacu'] != 0) {
            $errors['sp_giacu'] = 'Vui lòng nhập giá cũ';
        }elseif($data['sp_giacu'] != 0 && $data['sp_giacu']< $data['sp_gia']){
            $errors['sp_giacu'] = 'Giá cũ phải lớn hơn giá hiện tại';
        }
        if ($data['sp_km']=='') {
            $errors['sp_km'] = 'Vui lòng nhập khuyến mãi';
        }
        if ($data['th_id']=='') {
            $errors['th_id'] = 'Vui lòng chọn thương hiệu';
        }
        if ($data['sp_tskt']=='') {
            $errors['sp_tskt'] = 'Vui lòng nhập thông số kỹ thuật';
        }
        if ($data['sp_mtct']=='') {
            $errors['sp_mtct'] = 'Vui lòng mô tả chi tiết';
        }
        return $errors;
    }
}
