<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'donhang';
    protected $fillable = ['user_id', 'nh_id','ht_id','dh_status','dh_tong','dh_notes'];
    public function usernhanhang(){
        return $this->belongsTo(NhanHang::class,'nh_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function hinhthucthanhtoan(){
        return $this->belongsTo(HinhThucThanhToan::class,'ht_id','id');
    }
    public function sanpham()
	{
		return $this->belongsToMany(SanPham::class, 'chitietdonhang','dh_id','sp_id')->withPivot('id','ct_soluongmua','ct_gia')->withTimestamps();
	}
}
