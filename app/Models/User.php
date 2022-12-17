<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password','phone','address','quyen'];
    public function donhang(){
        return $this->hasMany (DonHang::class,'user_id','id');
    }
    public static function validate(array $data) {
        $errors = [];
        if ( $data['name']=='' ){
            $errors['name'] = 'Vui lòng nhập tên';
        }elseif(strlen($data['name']) < 6 ){
            $errors['name'] = 'Tên phải có ít nhất 6 ký tự';
        }
        if ( $data['address']=='' ){
            $errors['addrress'] = 'Vui lòng nhập địa chỉ';
        }elseif(strlen($data['address']) < 10 ){
            $errors['address'] = 'Địa chỉ phải có ít nhất 10 ký tự';
        }
        if ( $data['email']=='') {
            $errors['email'] = 'Vui lòng nhập email';
        } elseif (static::where('email', $data['email'])->count() > 0) {
            $errors['email'] = 'Email đã được sử dụng';
        }    
        if (! $data['phone']) {
            $errors['phone'] = 'Vui lòng nhập số điện thoại';
        } elseif (static::where('phone', $data['phone'])->count() > 0) {
            $errors['phone'] = 'Số điện thoại đã được sử dụng';
        }
        if (strlen($data['password']) < 6) {
            $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
        } elseif ($data['password'] != $data['passwordAgain']) {
            $errors['password'] = 'Mật khẩu không trùng khớp';
        }
        
        return $errors;
    }
    public static function validate_sua(array $data,$khachhang_id) {
        $errors = [];
        if ( $data['name']=='' ){
            $errors['name'] = 'Vui lòng nhập tên';
        }elseif(strlen($data['name']) < 6 ){
            $errors['name'] = 'Tên phải có ít nhất 6 ký tự';
        }
        if ( $data['address']=='' ){
            $errors['addrress'] = 'Vui lòng nhập địa chỉ';
        }elseif(strlen($data['address']) < 10 ){
            $errors['address'] = 'Địa chỉ phải có ít nhất 10 ký tự';
        }
        if (! $data['phone']) {
            $errors['phone'] = 'Vui lòng nhập số điện thoại';
        } elseif (static::where('phone', $data['phone'])->where('id','!=',$khachhang_id)->count() > 0) {
            $errors['phone'] = 'Số điện thoại đã được sử dụng';
        }
        if(isset($data['changePassword'])){
            if (strlen($data['password']) < 6) {
                $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            } elseif ($data['password'] != $data['passwordAgain']) {
                $errors['password'] = 'Mật khẩu không trùng khớp';
            }
        }
        
        return $errors;
    }
}
