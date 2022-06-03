<?php

namespace App\Modules\Thanhvien\Services;

use App\Helpers\TransformerResponse;
use App\Modules\Thanhvien\Repositories\ThanhvienRepository;
use App\Modules\Thanhvien\Repositories\Interfaces\ThanhvienRepositoryInterface;
use App\Modules\Thanhvien\Services\Interfaces\ThanhvienServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ThanhvienService implements ThanhvienServiceInterface
{
    private $transformerReponse;
    private $thanhvienRepository;
    
    public function __construct(
        TransformerResponse $transformerReponse,
        thanhvienRepositoryInterface $thanhvienRepository
    )
    {
        $this->transformerReponse = $transformerReponse;
        $this->thanhvienRepository = $thanhvienRepository;
    }

    /**
     * Get all Company
     * @return Response
     */
    public function getAll()
    {
        try {
            $thanhvien = $this->thanhvienRepository->getAll();
            return $this->transformerReponse->response(
                false,
                [
                    'thanhvien' => $thanhvien,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE, 
            );
        } catch (QueryException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }

    }

    /**
     * Get User by id
     * @param $idUser
     * @return Response
     * 
     */
    public function getById($id)
    {
        try {
            $thanhvien = $this->thanhvienRepository->getById($id);
            if(empty($thanhvien))  
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );

            return $this->transformerReponse->response(
                false,
                [
                    'thanhvien' => $thanhvien,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE, 
            );
        } catch (QueryException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    /**
     * create new emoloyee
     * @param Request
     * @return Response
     */
    public function create($request)
    {
        try {
            $validated = $request->validated();
            $thanhvien = $this->thanhvienRepository->create($validated);
            return $this->transformerReponse->response(
                false,
                [
                    'thanhvien' => $thanhvien,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::CREATE_SUCCESS_MESSAGE

            );
        } catch (QueryException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    /**
     * update employee
     * @param Request, id employee
     * @return Response
     */
    public function updateById($request, $id)
    {
        
        try {
            $validated = $request->validated();  
            $thanhvien = $this->thanhvienRepository->getById($id);
            if(empty($thanhvien)) 
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );
            
            $data = [
                'name' => $validated["name"],
                'email' => $validated["email"],
                'position' => $validated["position"],
                'lophoc_id' => $validated["lophoc_id"],
            ];    
            
            $this->thanhvienRepository->updateById($data, $id);
            return $this->transformerReponse->response(
                false,
                [
                    'thanhvien' => $thanhvien, 
                ],
                TransformerResponse::HTTP_OK, 
                TransformerResponse::UPDATE_SUCCESS_MESSAGE
                
        );
            
        } catch (QueryException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    /**
     * delete employee
     * @param Id employee
     * @return Response
     */
    public function deleteById($id)
    {
        try {
            $thanhvien = $this->thanhvienRepository->deleteById($id);
            if($thanhvien == false) 
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );

            return $this->transformerReponse->response(
                    false,
                    [],
                    TransformerResponse::HTTP_OK, 
                    TransformerResponse::DELETE_SUCCESS_MESSAGE
                    
                );
        } catch (QueryException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    /**
     * Get list emoloyee by id company
     * @param companyid
     * @return Response
     */
    public function getThanhvienCuaLophop($lophoc_id)
    {     
        try {
            $thanhvien = $this->thanhvienRepository->getThanhvienCuaLophoc($lophoc_id);
            if(empty($thanhvien->toArray()))  
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );

            return $this->transformerReponse->response(
                false,
                [
                    'thanhvien' => $thanhvien,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE, 
            );
        } catch (QueryException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerReponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

}