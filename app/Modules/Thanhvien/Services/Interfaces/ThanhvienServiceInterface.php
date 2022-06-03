<?php

namespace App\Modules\Thanhvien\Services\Interfaces;

interface ThanhvienServiceInterface
{
    public function getAll();
    public function getById($id);
    public function create($request);
    public function updateById($request, $id);
    public function deleteById($id);
    public function getThanhvienCuaLophop($lophoc_id);
}