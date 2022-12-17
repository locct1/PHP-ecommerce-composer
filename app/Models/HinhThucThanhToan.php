<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HinhThucThanhToan extends Model
{
    protected $table = 'hinhthucthanhtoan';
    protected $fillable = ['ht_ten'];
    public function donhang(){
        return $this->hasMany(DonHang::class,'ht_id','id');
    }
    public static function validate(array $data)
    {
        $errors = [];
        if (!$data['ht_ten']) {
            $errors['ht_ten'] = 'Vui lòng nhập tên hình thức thanh toán';
        }
      
        return $errors;
    }
   
}
