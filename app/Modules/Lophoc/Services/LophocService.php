<?php

namespace App\Modules\Lophoc\Services;

use App\Helpers\TransformerResponse;
use App\Modules\Lophoc\Repositories\Interfaces\LophocRepositoryInterface;
use App\Modules\Lophoc\Services\Interfaces\LophocServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class LophocService implements LophocServiceInterface
{

    private $transformerReponse;
    private $lophocRepository;

    public function __construct(
        TransformerResponse $tranformerReponse,
        LophocRepositoryInterface $lophocRepository
    )
    {
        $this->transformerReponse = $tranformerReponse;
        $this->lophocRepository = $lophocRepository;
    }

    /**
     * create new company
     * @param Request
     * @return Response
     */
    public function create($request)
    {
        try {
            $validated = $request->validated();
            
            $lophoc = $this->lophocRepository->create($validated);
            return $this->transformerReponse->response(
                false,
                [
                    'lophoc' => $lophoc,
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
     * get all company
     * @return Response
     */
    public function getAll()
    {
        try {
            $lophoc = $this->lophocRepository->getAll();
            return $this->transformerReponse->response(
                false,
                [
                    'lophoc' => $lophoc,
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
     * get company by id
     * @param idcompany
     * @return Response
     */
    public function getById($id)
    {
        try {
            $lophoc = $this->lophocRepository->getById($id);
            if(empty($lophoc))  
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );
            return $this->transformerReponse->response(
                false,
                [
                    'lophoc' => $lophoc,
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
     * delete company
     * @param idcompany
     * @return Response
     */
    public function deleteById($id)
    {
        try {
            $lophoc = $this->lophocRepository->deleteById($id);
            if($lophoc == false) 
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
     * update by id
     * @param Request, Id
     * @return Response
     */
    public function updateById($request, $id) 
    {
        
        try {
            $validated = $request->validated();  
            $lophoc = $this->lophocRepository->getById($id);
            if(empty($lophoc)) 
                return $this->transformerReponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE,
                );
            
                $data = [
                    'name' => $validated["name"],
                    'mota' => $validated["mota"],  
                ];
            $this->lophocRepository->updateById($data, $id);

            return $this->transformerReponse->response(
                false,
                [
                    'lophoc' => $data, 
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
}