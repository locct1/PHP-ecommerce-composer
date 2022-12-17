<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhanHang extends Model
{
    protected $table = 'nhanhang';
    protected $fillable = ['nh_name', 'nh_email','nh_address','nh_phone'];
    public function donhang(){
        return $this->hasMany(DonHang::class,'nh_id','id');
    }
    public static function validate(array $data) {
        $errors = [];
        if ( $data['nh_name']=='' ){
            $errors['nh_name'] = 'Vui lòng nhập tên';
        }elseif(strlen($data['nh_name']) < 6 ){
            $errors['nh_name'] = 'Tên phải có ít nhất 6 ký tự';
        }
        if ( $data['nh_address']=='' ){
            $errors['nh_addrress'] = 'Vui lòng nhập địa chỉ';
        }elseif(strlen($data['nh_address']) < 10 ){
            $errors['nh_address'] = 'Địa chỉ phải có ít nhất 10 ký tự';
        }
        if ( $data['nh_email']=='') {
            $errors['nh_email'] = 'Email không hợp lệ';
        }
        if (! $data['nh_phone']) {
            $errors['nh_phone'] = 'Vui lòng nhập số điện thoại';
        
        }
        
        return $errors;
    }
}
