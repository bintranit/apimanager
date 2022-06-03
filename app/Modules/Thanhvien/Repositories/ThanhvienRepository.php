<?php

namespace App\Modules\Thanhvien\Repositories;

use App\Modules\Thanhvien\Models\Thanhvien;
use App\Modules\Thanhvien\Repositories\Interfaces\ThanhvienRepositoryInterface;

class ThanhvienRepository implements ThanhvienRepositoryInterface
{
    public function create($validated)
    {
        return Thanhvien::create($validated);
    }

    public function getAll()
    {
       return Thanhvien::all();
    }

    public function getById($id)
    {
        return Thanhvien::find($id);
    }

    public function updateById( $data, $id)
    {
        return Thanhvien::where('id',$id)->update($data);
    }

    public function deleteById($id)
    {
        return Thanhvien::where('id',$id)->firstOrFail()->delete();
    }

    public function getThanhvienCuaLophoc($lophoc_id)
    {
        return Thanhvien::where('lophoc_id',$lophoc_id)->get();   
    }
}