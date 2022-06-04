<?php

namespace App\Modules\Lophoc\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Lophoc extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'lophocs';

    protected $fillable = [
        'name',
        'mota',];
    
    public function lophocs()
    {
        return $this->hasMany(Thanhvien::class, 'lophoc_id', 'id');
    }
}
