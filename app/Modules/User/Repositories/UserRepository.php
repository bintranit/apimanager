<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Models\User;
use App\Modules\User\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function create($validated) 
    {
        return User::create($validated);
    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function update($id ,$data)
    {
        return User::where('id', $id)
        ->update([
            'password' => $data
         ]);

    }
}