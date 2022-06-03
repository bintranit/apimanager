<?php

namespace App\Modules\Thanhvien\Models;

use App\Modules\Lophoc\Models\Lophoc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Thanhvien extends Model
{
    use HasFactory,HasApiTokens;


    protected $fillable = [
        'name',
        'email',
        'position',
        'lophoc_id',
    ];
    public function lophocs()
    {
        return $this->belongsTo(Lophoc::class);
    }
}