<?php
namespace App\Modules\Lophoc\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Lophoc\Requests\CreateLophocRequest;
use App\Modules\Lophoc\Requests\UpdateLophocRequest;
use App\Modules\Lophoc\Services\Interfaces\LophocServiceInterface;

class LophocController extends Controller
{
    private $lophocService;

    public function __construct(LophocServiceInterface $lophocService)
    {
        $this->lophocService = $lophocService;
    }

    public function getAll()
    {
        return $this->lophocService->getAll();
    }

    public function create(CreateLophocRequest $request)
    {
        return $this->lophocService->create($request);
    }

    public function updateById(UpdateLophocRequest $request, $id)
    {
        return $this->lophocService->updateById($request, $id);
    }

    public function getById($id)
    {
        return $this->lophocService->getById($id);
    }

    public function deleteById($id)
    {
        return $this->lophocService->deleteById($id);
    }
}