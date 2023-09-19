<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false; // set thời gian cho nó không chạy 
    protected $fillable = [
        'ten_danhmuc', 'meta_keywords', 'mota_danhmuc'
    ];
    protected $primaryKey = 'id_danhmuc';
    protected $table = 'danhmuc';

}
