<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'id_kh', 'id_tt', 'tinhtrang_dh', 'ma_dh', 'order_date', 'created_at'
    ];
    protected $primaryKey = 'id_dh';
    protected $table = 'donhang';

    public static function updateDonhangByMaDH($ma_dh, $tinhtrang_dh) {
        $donhang = Donhang::where('ma_dh', $ma_dh)->first();
        if ($donhang) {
            $donhang->tinhtrang_dh = $tinhtrang_dh;
            $donhang->save();
        }
    }

}
