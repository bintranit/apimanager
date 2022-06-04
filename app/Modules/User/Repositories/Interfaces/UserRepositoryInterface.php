<?php

namespace App\Modules\User\Repositories\Interfaces;

interface UserRepositoryInterface 
{
    public function create($validated);
    public function getById($id);
    public function update($id, $data);

}