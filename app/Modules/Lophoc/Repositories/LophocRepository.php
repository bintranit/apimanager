<?php

namespace App\Modules\Lophoc\Repositories;

use App\Modules\Lophoc\Models\Lophoc;
use App\Modules\Lophoc\Repositories\Interfaces\LophocRepositoryInterface;

class LophocRepository implements LophocRepositoryInterface
{
    public function getAll()
    {
        return Lophoc::all();
    }

    public function getById($id)
    {
        return Lophoc::find($id);
    }

    public function create($validated)
    {
        return Lophoc::create($validated);
    }

    public function deleteById($id)
    {
        return Lophoc::where('id', $id)->firstOrFail()->delete();       
    }

    public function updateById($data, $id)
    {
        return Lophoc::where('id', $id)->update($data);         
    }


}