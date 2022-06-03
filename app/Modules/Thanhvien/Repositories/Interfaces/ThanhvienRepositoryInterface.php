<?php

namespace App\Modules\Thanhvien\Repositories\Interfaces;

interface ThanhvienRepositoryInterface
{
    public function create($validated);
    public function getAll();
    public function getById($id);
    public function deleteById($id);
    public function updateById($data, $id);
    public function getThanhvienCuaLophoc($lophoc_id);
}