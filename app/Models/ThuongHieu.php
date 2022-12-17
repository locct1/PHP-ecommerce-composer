<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    protected $table = 'thuonghieu';
    protected $fillable = ['th_ten', 'th_hinhanh'];
    public function sanpham() {
        return $this->hasMany (SanPham::class,'th_id','id');
    }
    public static function validate(array $data)
    {
        $errors = [];
        if (!$data['th_ten']) {
            $errors['th_ten'] = 'Vui lòng nhập tên thương hiệu';
        }
        if (!$data['th_hinhanh']) {
            $errors['th_hinhanh'] = 'Vui lòng nhập hình ảnh';
        }
        return $errors;
    }
    public static function validate_sua(array $data)
    {
        $errors = [];
        if (!$data['th_ten']) {
            $errors['th_ten'] = 'Vui lòng nhập tên thương hiệu';
        }
        return $errors;
    }
}
