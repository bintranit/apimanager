<?php

namespace App\Modules\Thanhvien\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Thanhvien\Services\Interfaces\ThanhvienServiceInterface;
use App\Modules\Thanhvien\Requests\CreateThanhvienRequest;
use App\Modules\Thanhvien\Requests\UpdateThanhvienRequest;

class ThanhvienController extends Controller 
{

    private $thanhvienService;

    public function __construct(ThanhvienServiceInterface $thanhvienService)
    {
        $this->thanhvienService = $thanhvienService;
    }

    public function create(CreateThanhvienRequest $request)
    {
       return $this->thanhvienService->create($request);
        
    }

    public function getAll()
    {
        return $this->thanhvienService->getAll();
       
    }

    public function getById($id)
    {
        return $this->thanhvienService->getById($id);
    }

    public function updateById(UpdateThanhvienRequest $request, $id)
    {
        return $this->thanhvienService->updateById($request, $id);
        
    }

    public function deleteById($id)
    {
        return $this->thanhvienService->deleteById($id);        

    }

    public function getThanhvienCuaLophop($lophoc_id)
    {    
        return $this->thanhvienService->getThanhvienCuaLophop($lophoc_id);   
    }


}