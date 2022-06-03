<?php

namespace App\Modules\Lophoc\Services\Interfaces;

interface LophocServiceInterface 
{
    public function getAll();
    public function create($request);
    public function updateById($request, $id);
    public function getById($id);
    public function deleteById($id);
}