<?php

namespace App\Modules\Lophoc\Repositories\Interfaces;

interface LophocRepositoryInterface
{
    public function getAll();
    public function create($validated);
    public function getById($id);
    public function updateById($validated, $id);
    public function deleteById($id);
}